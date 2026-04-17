<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout')]
    public function index(
        Request $request,
        RequestStack $requestStack,
        ProductRepository $productRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $session = $requestStack->getSession();
        $cart = $session->get('cart', []);

        if (empty($cart)) {
            $this->addFlash('warning', 'La teva cistella està buida!');
            return $this->redirectToRoute('app_home');
        }

        if ($request->isMethod('POST')) {
            $email = $request->request->get('client_email');

            Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

            $lineItems = [];
            $total = 0;

            foreach ($cart as $id => $quantity) {
                $product = $productRepository->find($id);
                if (!$product) continue;

                $total += $product->getPrice() * $quantity;

                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => $product->getPrice(),
                        'product_data' => [
                            'name' => $product->getName(),
                        ],
                    ],
                    'quantity' => $quantity,
                ];
            }

            $order = new Order();
            $order->setClientEmail($email);
            $order->setStatus('pending');
            $order->setTotalPrice($total);
            $order->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($order);
            $entityManager->flush();

            $stripeSession = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => $email,
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => $this->generateUrl('app_checkout_success', ['id' => $order->getId()], UrlGeneratorInterface::ABSOLUTE_URL),
                'cancel_url' => $this->generateUrl('app_cart', [], UrlGeneratorInterface::ABSOLUTE_URL),
            ]);

            $order->setStripeSessionId($stripeSession->id);
            $entityManager->flush();

            return $this->redirect($stripeSession->url, 303);
        }

        return $this->render('checkout/index.html.twig');
    }

    #[Route('/checkout/success/{id}', name: 'app_checkout_success')]
    public function success(
        Order $order,
        EntityManagerInterface $entityManager,
        RequestStack $requestStack
    ): Response {
        if ($order->getStatus() === 'pending') {
            $order->setStatus('processing');
            $entityManager->flush();
        }

        $session = $requestStack->getSession();
        $session->remove('cart');

        return $this->render('checkout/success.html.twig', [
            'order' => $order
        ]);
    }
}
