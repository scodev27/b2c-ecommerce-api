<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout')]
    public function index(Request $request, RequestStack $requestStack, ProductRepository $productRepository, EntityManagerInterface $entityManager): Response
    {
        $session = $requestStack->getSession();
        $cart = $session->get('cart', []);

        if (empty($cart)) {
            $this->addFlash('warning', 'La teva cistella està buida!');
            return $this->redirectToRoute('app_home');
        }

        if ($request->isMethod('POST')) {
            $email = $request->request->get('client_email');

            $total = 0;
            foreach ($cart as $id => $quantity) {
                $product = $productRepository->find($id);
                if ($product) {
                    $total += $product->getPrice() * $quantity;
                }
            }

            $order = new Order();
            $order->setClientEmail($email);
            $order->setStatus('pending'); // Pendent de pagament/enviament
            $order->setTotalPrice($total);
            $order->setCreatedAt(new \DateTimeImmutable());

            $entityManager->persist($order);
            $entityManager->flush();

            $session->remove('cart');

            return $this->redirectToRoute('app_checkout_success');
        }

        return $this->render('checkout/index.html.twig');
    }

    #[Route('/checkout/success', name: 'app_checkout_success')]
    public function success(): Response
    {
        return $this->render('checkout/success.html.twig');
    }
}
