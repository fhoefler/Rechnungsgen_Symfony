<?php

namespace App\Controller;

use App\Entity\Firma;
use App\Entity\Kunden;
use App\Entity\Rechnungspositionen;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechnungspositionsController extends AbstractController
{
    #[Route('/rechnungspositions/{id}', name: 'app_rechnungspositions')]
    public function index(ManagerRegistry $registry, int $id): Response
    {
        if($id == 0)  {
            $data = "Kunden auswählen";
            $rechnungsposition = 127;
        } else {
            $data = $registry->getManager()->getRepository(Kunden::class)->findOneById($id)->getName();
            $rechnungsposition = 100;
        }

        return $this->render('Rechnungsgen/Rechnung.html.twig', [
            'kunde' => $data,
            'rechnung' => $rechnungsposition
        ]);
    }

    #[Route('/rechnung/kunden', name: 'app_kunden_rechnungspositions')]
    public function kunden(ManagerRegistry $registry): Response
    {

        $data = $registry->getManager()->getRepository(Kunden::class)->findAll();

        return $this->render('Rechnungsgen/Choose/RechnungKunden.html.twig', [
            'car_form' => $data

        ]);
    }
}
