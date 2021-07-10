<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}/details', name: 'product.details')]
    public function details(Product $product)
    {
        return $this->render('product/details.html.twig', [
            'product' => $product
        ]);
    }
}
