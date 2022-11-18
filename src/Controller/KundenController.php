<?php

namespace App\Controller;

use App\Entity\Kunden;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KundenController extends AbstractController
{
    #[Route('/kunden', name: 'app_kunden')]
    public function index(): Response
    {
        $data = null;
        $data = $this->getDoctrine()->getRepository(Kunden::class)->findAll();

        return $this->render('Rechnungsgen/Product.html.twig', [
            'car_form' => $data
        ]);
    }


    #[Route('/createkunden', name: 'app_createkunden')]
    public function create(Request $request): Response
    {
        if ($request->getMethod() === "POST") {

            /**
             * @Var Kunden $kunden
             */

            $kunden = new Kunden();
            $kunden->setName($request->get("name"));
            $kunden->setEmail($request->get("email"));
            $kunden->setTel($request->get("telnr"));
            $kunden->setAddresse($request->get("adress"));
            $kunden->setFirma(1);
            $kunden->setKundennummer($request->get("kundnr"));
            $kunden->setPlz($request->get("plz"));
            $kunden->setStadt($request->get("city"));
            $kunden->setUid($request->get("uid"));
            $kunden->setFntz($request->get("fest"));
            $kunden->setFn($request->get("fn"));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kunden);
            $entityManager->flush();
            return $this->render('Rechnungsgen/index.html.twig');
        }
        return $this->render('Rechnungsgen/Create/CreateCustomer.html.twig', [
            'controller_name' => 'KundenController',
        ]);
    }
}
