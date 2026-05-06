<?php

namespace App\Controller\Api;

use App\Entity\Order;
use App\Message\SendEmailMessage;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use OpenApi\Attributes as OA;

#[Route('/api')]
class ProductApiController extends AbstractController
{
    #[Route('/products', name: 'api_products_list', methods: ['GET'])]
    public function list(ProductRepository $productRepository): JsonResponse
    {
        $products = $productRepository->findAll();
        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice() / 100,
            ];
        }
        return new JsonResponse($data);
    }

    #[Route('/products/{id}', name: 'api_product_detail', methods: ['GET'])]
    public function detail(string $id, ProductRepository $productRepository): JsonResponse
    {
        $product = $productRepository->find($id);
        if (!$product) {
            return new JsonResponse(['error' => 'Producte no trobat'], 404);
        }

        return new JsonResponse([
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice() / 100,
            'image' => $product->getImage(),
            'stock' => $product->getStock()
        ]);
    }

    #[Route('/order', name: 'api_make_order', methods: ['POST'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'email', type: 'string', example: 'prova@gmail.com'),
                new OA\Property(property: 'product_id', type: 'string', example: 'ENGANXA_AQUI_EL_TEU_UUID')
            ]
        )
    )]

    public function makeOrder(
        Request $request,
        ProductRepository $productRepository,
        EntityManagerInterface $entityManager,
        MessageBusInterface $messageBus
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        $email = $data['email'] ?? null;
        $productId = $data['product_id'] ?? null;

        if (!$email || !$productId) {
            return new JsonResponse(['error' => 'Falta email o product_id'], 400);
        }

        $product = $productRepository->find($productId);
        if (!$product) return new JsonResponse(['error' => 'Producte no trobat'], 404);

        $order = new Order();
        $order->setClientEmail($email);
        $order->setStatus('pending');
        $order->setTotalPrice($product->getPrice());
        $order->setCreatedAt(new \DateTimeImmutable());
        $entityManager->persist($order);
        $entityManager->flush();

        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
        $stripeSession = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $email,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $product->getPrice(),
                    'product_data' => ['name' => $product->getName()],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('app_checkout_success', ['id' => $order->getId()], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('app_cart', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        $order->setStripeSessionId($stripeSession->id);
        $entityManager->flush();

        $messageBus->dispatch(new SendEmailMessage(
            (string) $order->getId(),
            $email,
            'payment_link',
            $stripeSession->url
        ));

        return new JsonResponse([
            'transaction_id' => $order->getId(),
            'payment_url' => $stripeSession->url
        ]);
    }
}
