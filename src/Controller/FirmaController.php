<?php

namespace App\Controller;

use App\Entity\Firma;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirmaController extends AbstractController
{
    #[Route('/firma', name: 'app_firma')]
    public function index(ManagerRegistry $registry): Response
    {
        $data = $registry->getManager()->getRepository(Firma::class)->findAll();

        return $this->render('Rechnungsgen/Firma.html.twig', [
            'car_form' => $data
        ]);
    }

    #[Route('/createfirma', name: 'app_createfirma')]
    public function create(Request $request, ManagerRegistry $registry): Response
    {
        if ($request->getMethod() === "POST") {

            /**
             * @Var Produkt $firma
             */

            $firma = new Firma();



            $entityManager = $registry->getManager();
            $entityManager->persist($firma);
            $entityManager->flush();
            return $this->render('Rechnungsgen/index.html.twig');
        }
        return $this->render('Rechnungsgen/Create/CreateFirma.html.twig', [
            'controller_name' => 'FirmaController',
        ]);
    }


    #[Route('/changefirma/{id}', name: 'app_changefirma', requirements: ["id" => "\d+"])]
    public function change(Request $request, ManagerRegistry $registry, int $id): Response
    {
        if ($request->getMethod() === "POST") {

            /**
             * @Var Firma $produkt
             */

            $produkt = $registry->getManager()->getRepository(Firma::class)->findOneById($id);
            $produkt->setName($request->get("name"));
            $produkt->setInfo($request->get("info"));
            $produkt->setEZPreisNetto($request->get("price"));
            $produkt->setLagerbestand($request->get("lager"));
            $produkt->setMwst($request->get("mwst"));


            $entityManager = $registry->getManager();
            $entityManager->persist($produkt);
            $entityManager->flush();
            return $this->render('Rechnungsgen/index.html.twig');
        }

        $data = $registry->getManager()->getRepository(Firma::class)->findOneById($id);

        return $this->renderForm('Rechnungsgen/Change/ChangeFirma.html.twig', [
            'product' => $data
        ]);
    }

    #[Route('/deletefirma/{id}', name: 'app_delete')]
    public function delete(ManagerRegistry $registry, int $id): Response
    {
        $data = null;
        $data = $registry->getManager()->getRepository(Firma::class)->findOneById($id);
        $registry->getManager()->remove($data);
        $registry->getManager()->flush();

        $data = null;
        $data = $registry->getManager()->getRepository(Firma::class)->findAll();


        return $this->render('Rechnungsgen/Firma.html.twig', [
            'car_form' => $data
        ]);

    }
}
