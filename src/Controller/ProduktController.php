<?php

namespace App\Controller;

use App\Entity\Produkt;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduktController extends AbstractController
{
    #[Route('/produkt', name: 'app_produkt')]
    public function index(): Response
    {
        $data = null;
        $data = $this->getDoctrine()->getRepository(Produkt::class)->findAll();

        return $this->render('Rechnungsgen/Product.html.twig', [
            'car_form' => $data
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
