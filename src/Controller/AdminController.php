<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('admin/index.html.twig', [
            'orders' => $orders,
        ]);
    }
}
