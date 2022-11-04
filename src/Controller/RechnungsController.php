<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechnungsController extends AbstractController
{
    #[Route('/rechnungs', name: 'app_rechnungs')]
    public function index(): Response
    {
        return $this->render('rechnungs/index.html.twig', [
            'controller_name' => 'RechnungsController',
        ]);
    }
}
