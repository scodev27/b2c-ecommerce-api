<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(CartService $cartService): Response
    {
        return $this->render('cart/index.html.twig', [
            // Només hem de cridar a les funcions del nostre servei
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal()
        ]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function add(string $id, CartService $cartService): Response
    {
        $cartService->add($id);

        $this->addFlash('success', 'Producte afegit a la cistella correctament! 🛒');
        return $this->redirectToRoute('app_home');
    }

    #[Route('/cart/remove/{id}', name: 'cart_remove')]
    public function remove(string $id, CartService $cartService): Response
    {
        $cartService->remove($id);
        return $this->redirectToRoute('app_cart');
    }
}
