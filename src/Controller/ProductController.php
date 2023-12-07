<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\Converteur;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll()
        ]);
    }

    #[Route('/product/{id}', name: 'app_product_details')]
    public function show(Product $product, Converteur $converteur): Response
    {

        $dollar_price = $converteur->convertEurToDollar($product->getPrice());
        $yen_price = $converteur->convertEurToYen($product->getPrice());

        return $this->render('product/details.html.twig', [
            'product' => $product,
            'dollar_price' => $dollar_price,
            'yen_price' => $yen_price,
        ]);
    }
}
