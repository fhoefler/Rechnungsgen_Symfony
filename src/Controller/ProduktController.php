<?php

namespace App\Controller;

use App\Entity\Department;
use App\Entity\Produkt;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function create(Request $request, ManagerRegistry $registry): Response
    {
        if ($request->getMethod() === "POST") {

            /**
             * @Var Produkt $produkt
             */

            $produkt = new Produkt();
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
        return $this->render('Rechnungsgen/Create/CreateProduct.html.twig', [
            'controller_name' => 'ProduktController',
        ]);
    }


    #[Route('/changeproduct/{id}', name: 'app_changeprodukte', requirements: ["id" => "\d+"])]
    public function change(Request $request, ManagerRegistry $registry, int $id): Response
    {
        if ($request->getMethod() === "POST") {

            /**
             * @Var Produkt $produkt
             */

            $produkt = $registry->getManager()->getRepository(Produkt::class)->findOneById($id);
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

        $data = $registry->getManager()->getRepository(Produkt::class)->findOneById($id);

        return $this->renderForm('Rechnungsgen/Change/ChangeProduct.html.twig', [
            'product' => $data
        ]);
    }

    #[Route('/deleteproduct/{id}', name: 'app_delete')]
    public function delete(ManagerRegistry $registry, int $id): Response
    {
        $data = null;
        $data = $registry->getManager()->getRepository(Produkt::class)->findOneById($id);
        $registry->getManager()->remove($data);
        $registry->getManager()->flush();


        $data = null;
        $data = $registry->getManager()->getRepository(Produkt::class)->findAll();


        return $this->render('Rechnungsgen/Product.html.twig', [
            'car_form' => $data
        ]);

    }
}
