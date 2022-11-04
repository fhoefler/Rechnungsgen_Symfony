<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirmaController extends AbstractController
{
    #[Route('/firma', name: 'app_firma')]
    public function index(): Response
    {
        return $this->render('firma/index.html.twig', [
            'controller_name' => 'FirmaController',
        ]);
    }
}
