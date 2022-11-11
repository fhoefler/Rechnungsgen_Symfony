<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduktController extends AbstractController
{
    #[Route('/produkt', name: 'app_produkt')]
    public function index(): Response
    {
        return $this->render('Rechnungsgen/Product.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }


    #[Route('/createprodukt', name: 'app_createprodukte')]
    public function create(): Response
    {
        return $this->render('Rechnungsgen/Create/CreateProduct.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
}
