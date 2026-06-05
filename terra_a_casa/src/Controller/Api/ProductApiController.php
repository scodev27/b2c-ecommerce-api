<?php

namespace App\Controller\Api;

use App\Entity\Order;
use App\Message\SendEmailMessage;
use App\Repository\ProductRepository;
use App\Service\CacheManager;
use Doctrine\ORM\EntityManagerInterface;
use OpenApi\Attributes as OA;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[Route('/api')]
class ProductApiController extends AbstractController
{
    #[Route('/products', name: 'api_products_list', methods: ['GET'])]
    public function list(ProductRepository $productRepository, CacheManager $cacheManager): JsonResponse
    {
        $data = $cacheManager->get('productes_cataleg');

        if (!$data) {
            $products = $productRepository->findAll();
            $data = [];

            foreach ($products as $product) {
                $data[] = [
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'price' => $product->getPrice() / 100,
                    'image' => $product->getImage(),
                ];
            }

            $cacheManager->set('productes_cataleg', $data, 3600);
        }

        return new JsonResponse($data);
    }

    #[Route('/products/{id}', name: 'api_product_detail', methods: ['GET'])]
    public function detail(string $id, ProductRepository $productRepository, CacheManager $cacheManager): JsonResponse
    {
        $cacheKey = 'producte_detall_' . $id;

        $data = $cacheManager->get($cacheKey);

        if (!$data) {
            $product = $productRepository->find($id);

            if (!$product) {
                return new JsonResponse(['error' => 'Producte no trobat'], 404);
            }

            $data = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'price' => $product->getPrice() / 100,
                'image' => $product->getImage(),
                'stock' => $product->getStock()
            ];

            $cacheManager->set($cacheKey, $data, 3600);
        }

        return new JsonResponse($data);
    }

    #[Route('/order', name: 'api_make_order', methods: ['POST'])]
    #[OA\RequestBody(
        description: "Dades necessàries per crear una comanda",
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "email", type: "string", example: "client@terraacasa.cat"),
                new OA\Property(property: "product_id", type: "string", example: "ID-DEL-PRODUCTE-AQUI"),
                new OA\Property(property: "total_price", type: "integer", example: 1500, description: "Preu en cèntims")
            ],
            type: "object"
        )
    )]
    #[OA\Response(
        response: 200,
        description: "Retorna l'ID de la transacció i l'enllaç de pagament de Stripe"
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
        $totalPrice = $data['total_price'] ?? null;

        if (!$email || !$productId) {
            return new JsonResponse(['error' => 'Falta email o product_id'], 400);
        }

        $product = $productRepository->find($productId);
        if (!$product) return new JsonResponse(['error' => 'Producte no trobat'], 404);

        $finalPrice = $totalPrice ?? $product->getPrice();

        $order = new Order();
        $order->setClientEmail($email);
        $order->setStatus('pending');
        $order->setTotalPrice($finalPrice);
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
                    'unit_amount' => $finalPrice,
                    'product_data' => ['name' => 'Compra a Terra a Casa'],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('app_checkout_success', ['id' => $order->getId()], UrlGeneratorInterface::ABSOLUTE_URL) . '?clear_cart=1',
            'cancel_url' => 'http://localhost:5500',
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
