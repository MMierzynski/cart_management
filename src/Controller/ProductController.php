<?php

namespace App\Controller;

use App\Entity\CartItem;
use App\Entity\Product;
use App\Form\AddToCartType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}/details', name: 'product.details')]
    public function details(Product $product, Request $request)
    {
        $form = $this->createForm(AddToCartType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CartItem $cartItem */
            $cartItem = $form->getData();
            $cartItem->setProduct($product);
        }

        return $this->render('product/details.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}
