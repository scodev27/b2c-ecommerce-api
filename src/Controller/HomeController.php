<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository, CacheInterface $cache): Response
    {
        $products = $cache->get('productes_inici', function (ItemInterface $item) use ($productRepository) {
            $item->expiresAfter(3600);

            return $productRepository->findAll();
        });

        return $this->render('home/index.html.twig', [
            'products' => $products,
        ]);
    }
}
