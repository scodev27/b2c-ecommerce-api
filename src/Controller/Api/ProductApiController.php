<?php

namespace App\Controller\Api;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

#[Route('/api')]
class ProductApiController extends AbstractController
{
    #[Route('/products', name: 'api_products_list', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Retorna la llista de totes les capses de verdures i fruites en format JSON',
    )]
    #[OA\Tag(name: 'Productes')]
    public function list(ProductRepository $productRepository): JsonResponse
    {
        $products = $productRepository->findAll();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'price' => $product->getPrice() / 100,
                'image' => $product->getImage(),
                'stock' => $product->getStock()
            ];
        }

        return new JsonResponse($data);
    }
}
