<?php

namespace App\Controller;

use App\Entity\Order;
use App\Message\SendEmailMessage;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
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

    #[Route('/admin/order/{id}/status/{status}', name: 'admin_order_status')]
    public function updateStatus(
        Order                                            $order,
        string                                           $status,
        EntityManagerInterface                           $entityManager,
        MessageBusInterface $messageBus
    ): Response
    {
        $validStatuses = ['pending', 'processing', 'delivering', 'completed'];

        if (in_array($status, $validStatuses)) {
            $order->setStatus($status);
            $entityManager->flush();

            if ($status === 'delivering' || $status === 'completed') {
                $messageBus->dispatch(new SendEmailMessage((string)$order->getId(), $order->getClientEmail(), $status));
            }

            $this->addFlash('success', 'Estat de la comanda actualitzat correctament!');
        }

        return $this->redirectToRoute('app_admin');
    }
}
