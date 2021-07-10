<?php

namespace App\Controller;

use App\Cart\Factory\CartFactory;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $entityManager, CartFactory $cartFactory): Response
    {
        $productRepository = $entityManager->getRepository(Product::class);
        $cartFactory->create();

        return $this->render('home/index.html.twig', [
            'products' => $productRepository->findAll()
        ]);
    }
}
