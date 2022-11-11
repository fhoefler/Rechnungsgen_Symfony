<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KundenController extends AbstractController
{
    #[Route('/kunden', name: 'app_kunden')]
    public function index(): Response
    {
        return $this->render('Rechnungsgen/Kunden.html.twig', [
            'controller_name' => 'KundenController',
        ]);
    }
}
