<?php

namespace App\Controller;

use App\Entity\Department;
use App\Entity\Produkt;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduktController extends AbstractController
{
    #[Route('/produkt', name: 'app_produkt')]
    public function index(ManagerRegistry $registry): Response
    {
        $data = null;
        $data = $registry->getManager()->getRepository(Produkt::class)->findAll();


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


    #[Route('/changeproduct/{id}', name: 'app_changeprodukte')]
    public function change(ManagerRegistry $registry, int $id): Response
    {
        $data = $registry->getManager()->getRepository(Produkt::class)->findOneById($id);

        return $this->render('Rechnungsgen/Change/ChangeProduct.html.twig', [
            'product' => $data
        ]);
    }
}
