<?php


namespace App\Cart\Factory;


use App\Entity\Cart;
use App\Entity\User;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class CartFactory
{

    private Security $security;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function create(): ?Cart
    {
        /** @var User $user */
        $user = $this->security->getUser();

        if (!$user) {
            return null;
        }

        /** @var CartRepository $cartRepository */
        $cartRepository = $this->entityManager->getRepository(Cart::class);
        $cart = $cartRepository->findDefaultCartForUser($user->getId());

        if (!$cart) {
            $cart = new Cart();
            $cart->setUser($user)
                ->setName('default');

            $this->entityManager->persist($cart);
            $this->entityManager->flush();
        }

        return $cart;
    }
}