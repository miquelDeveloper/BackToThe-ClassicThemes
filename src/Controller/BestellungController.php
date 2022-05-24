<?php

namespace App\Controller;

use App\Entity\Bestellung;
use App\Entity\Gericht;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BestellungController extends AbstractController
{
    /**
     * @Route("/bestellung", name="app_bestellung")
     */
    public function index(): Response
    {
        return $this->render('bestellung/index.html.twig', [
            'controller_name' => 'BestellungController',
        ]);
    }
    /**
     * @Route("/bestellen/{id}", name="bestellen")
     */
    public function bestellen(Gericht $gericht,ManagerRegistry $doctrine){
        $bestellung = new Bestellung();
        $bestellung->setTisch('tisch1');
        $bestellung->setName($gericht->getName());
        $bestellung->setBnumber($gericht->getId());
        $bestellung->setPreis($gericht->getPreis());
        $bestellung->setStatus('offen');

        $em = $doctrine->getManager();
        $em->persist($bestellung);
        $em->flush();

        $this->addFlash('bestell', $bestellung->getName(). ' was added to the order');

        return $this->redirect($this->generateUrl('menu'));

    }
}
