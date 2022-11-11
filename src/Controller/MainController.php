<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/rechnungs', name: 'app_rechnungs')]
    public function index(): Response
    {
        return $this->render('Rechnungsgen/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
