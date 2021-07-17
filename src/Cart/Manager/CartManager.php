<?php


namespace App\Cart\Manager;


use App\Cart\Factory\CartFactory;
use App\Entity\Cart;
use Doctrine\ORM\EntityManagerInterface;

class CartManager
{
    private CartFactory $cartFactory;
    private EntityManagerInterface $entityManager;

    public function __construct(CartFactory $cartFactory, EntityManagerInterface $entityManager)
    {
        $this->cartFactory = $cartFactory;
        $this->entityManager = $entityManager;
    }

    public function getCart(): ?Cart
    {
        return $this->cartFactory->create();
    }

    public function updateCart(Cart $cart): void
    {
        foreach ($cart->getItems() as $cartItem){
            $this->entityManager->persist($cartItem);
        }

        $this->entityManager->flush();
    }

    public function removeCart(Cart $cart): void
    {
        $this->entityManager->remove($cart);
    }
}