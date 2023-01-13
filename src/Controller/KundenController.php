<?php

namespace App\Controller;

use App\Entity\Firma;
use App\Entity\Kunden;
use App\Entity\Produkt;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KundenController extends AbstractController
{
    #[Route('/kunden', name: 'app_kunden')]
    public function index(ManagerRegistry $registry): Response
    {

        $data = null;
        $data = $registry->getManager()->getRepository(Kunden::class)->findAll();

        return $this->render('Rechnungsgen/Kunden.html.twig', [
            'car_form' => $data
        ]);
    }


    #[Route('/createkunden', name: 'app_createkunden')]
    public function create(Request $request, ManagerRegistry $registry): Response
    {
        if ($request->getMethod() === "POST") {

            /**
             * @Var Kunden $kunden
             */

            $firma = new Firma();
            $firma = $registry->getManager()->getRepository(Firma::class)->findOneById(1);

            $kunden = new Kunden();
            $kunden->setName($request->get("name"));
            $kunden->setEmail($request->get("email"));
            $kunden->setTel($request->get("telnr"));
            $kunden->setAddresse($request->get("adress"));
            $kunden->setFirma($firma);
            $kunden->setKundennummer($request->get("kundnr"));
            $kunden->setPlz($request->get("plz"));
            $kunden->setStadt($request->get("city"));
            $kunden->setUid($request->get("uid"));
            $kunden->setFntz($request->get("fest"));
            $kunden->setFn($request->get("fn"));

            $entityManager = $registry->getManager();
            $entityManager->persist($kunden);
            $entityManager->flush();
            return $this->render('Rechnungsgen/index.html.twig');
        }
        return $this->render('Rechnungsgen/Create/CreateCustomer.html.twig', [
            'controller_name' => 'KundenController',
        ]);
    }


    #[Route('/changekunden/{id}', name: 'app_changkunden')]
    public function change(Request $request, ManagerRegistry $registry, int $id): Response
    {
        if ($request->getMethod() === "POST") {

            $kunden = $registry->getManager()->getRepository(Kunden::class)->findOneById($id);
            $kunden->setName($request->get("name"));
            $kunden->setEmail($request->get("email"));
            $kunden->setTel($request->get("telnr"));
            $kunden->setAddresse($request->get("adress"));
            $kunden->setPlz($request->get("plz"));
            $kunden->setStadt($request->get("city"));
            $kunden->setUid($request->get("uid"));
            $kunden->setFntz($request->get("fest"));
            $kunden->setFn($request->get("fn"));


            $entityManager = $registry->getManager();
            $entityManager->persist($kunden);
            $entityManager->flush();
            return $this->render('Rechnungsgen/index.html.twig');

        }

        $data = $registry->getManager()->getRepository(Kunden::class)->findOneById($id);

        return $this->render('Rechnungsgen/Change/ChangeKunden.html.twig', [
            'data' => $data
        ]);
    }


    #[Route('/deletekunden/{id}', name: 'app_kundendelete')]
    public function delete(ManagerRegistry $registry, int $id): Response
    {
        $data = null;
        $data = $registry->getManager()->getRepository(Kunden::class)->findOneById($id);
        $registry->getManager()->remove($data);
        $registry->getManager()->flush();


        $data = null;
        $data = $registry->getManager()->getRepository(Kunden::class)->findAll();


        return $this->render('Rechnungsgen/Kunden.html.twig', [
            'car_form' => $data
        ]);

    }
}
