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
        return $this->render('produkt/index.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }
}
