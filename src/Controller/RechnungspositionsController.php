<?php

namespace App\Controller;

use App\Entity\Kunden;
use App\Entity\Produkt;
use App\Entity\Rechnung;
use App\Entity\Rechnungspositionen;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechnungspositionsController extends AbstractController
{
    #[Route('/rechnungspositions/{id}/{id2}', name: 'app_rechnungspositions')]
    public function index(Request $request, ManagerRegistry $registry, int $id, int $id2): Response
    {

        if($id == 0)  {
            $data = "Kunden auswählen";
            $rechnungsposition = 127;
            $kunde = $registry->getManager()->getRepository(Kunden::class)->findOneById(6);
            $rechnung = new Rechnung();
            $rechnung->setNettopreis(0);
            $rechnung->setMenge(0);
            $rechnung->setKunde($kunde);

            $entityManager = $registry->getManager();
            $entityManager->persist($rechnung);
            $entityManager->flush();

        } else {
            $data = $registry->getManager()->getRepository(Kunden::class)->findOneById($id)->getName();
            $kunde = $registry->getManager()->getRepository(Kunden::class)->findOneById($id);
            $rechnung = $registry->getManager()->getRepository(Rechnung::class)->findOneById($id2);
            $rechnung->setKunde($kunde);
            $rechnungsposition = 100;

            $entityManager = $registry->getManager();
            $entityManager->persist($rechnung);
            $entityManager->flush();
        }



        $pro = 0;
        $produkt = 0;
        if($request->get("id") != 0) {

            $produkt = $request->get("name");
            #$pro = $registry->getManager()->getRepository(Produkt::class)->findOneById($produkt)->getName();
        }

        return $this->render('Rechnungsgen/Rechnung.html.twig', [
            'kunde' => $data,
            'rechnung' => $rechnungsposition,
            'produkt' => $produkt,
            'rechnungs' => $rechnung
        ]);
    }

    #[Route('/rechnung/kunden/{id}', name: 'app_kunden_rechnungspositions')]
    public function kunden(Request $request, ManagerRegistry $registry, int $id): Response
    {
        $data = $registry->getManager()->getRepository(Kunden::class)->findAll();



        if ($request->getMethod() === "POST") {

            /**
             * @Var Produkt $rechnung
             */


            return $this->render('Rechnungsgen/index.html.twig');
        }


        return $this->render('Rechnungsgen/Choose/RechnungKunden.html.twig', [
            'car_form' => $data,
            'rechnung' => $id

        ]);
    }

    #[Route('/rechnung/produkt', name: 'app_produkt_rechnungspositions')]
    public function produkt(Request $request, ManagerRegistry $registry): Response
    {

        $data = $registry->getManager()->getRepository(Produkt::class)->findAll();

        if ($request->getMethod() === "POST") {
            $rechnungspos = new Rechnungspositionen();
            $rechnungspos->setName($request->get("name"));



            $entityManager = $registry->getManager();
            $entityManager->persist($rechnungspos);
            $entityManager->flush();
        }

        return $this->render('Rechnungsgen/Choose/RechnungProdukt.html.twig', [
            'car_form' => $data

        ]);
    }
}
