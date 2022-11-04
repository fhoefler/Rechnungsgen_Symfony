<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechnungspositionsController extends AbstractController
{
    #[Route('/rechnungspositions', name: 'app_rechnungspositions')]
    public function index(): Response
    {
        return $this->render('rechnungspositions/index.html.twig', [
            'controller_name' => 'RechnungspositionsController',
        ]);
    }
}
