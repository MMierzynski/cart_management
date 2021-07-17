<?php

namespace App\Controller;

use App\Cart\Manager\CartManager;
use App\Entity\CartItem;
use App\Entity\Product;
use App\Form\AddToCartType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/{id}/details', name: 'product.details')]
    public function details(Product $product, CartManager $cartManager, Request $request): Response
    {
        $form = $this->createForm(AddToCartType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cart = $cartManager->getCart();
            if (!$cart) {

            }

            /** @var CartItem $cartItem */
            $cartItem = $form->getData();
            $cartItem->setProduct($product);

            $cart->addItem($cartItem);
            $cartManager->updateCart($cart);
            dd($cartManager->getCart());
        }

        return $this->render('product/details.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}
