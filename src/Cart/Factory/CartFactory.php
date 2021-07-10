<?php


namespace App\Cart\Factory;


use App\Entity\Cart;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class CartFactory
{
    private EntityManagerInterface $entityManager;
    private Security $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function create(): ?Cart
    {
        /** @var User $user */
        $user = $this->security->getUser();

        if (!$user) {
            return null;
        }

        $cartRepository = $this->entityManager->getRepository(Cart::class);
        $cart = $cartRepository->findDefaultCartForUser($user->getId());

        dump($cart);

        if (!$cart) {
            $cart = new Cart();
            $cart->setUser($user)
                ->setName('default');

            $this->entityManager->persist($cart);
            $this->entityManager->flush();
        }
        dump($cart);


        return $cart;
    }
}