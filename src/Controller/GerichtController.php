<?php

namespace App\Controller;

use App\Entity\Gericht;
use App\Form\GerichtType;
use App\Repository\GerichtRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/gericht", name="gericht.")
     */
class GerichtController extends AbstractController
{
    /**
     * @Route("/", name="bearbeiten")
     */
    public function index(GerichtRepository $gr): Response
    {
        $gerichte = $gr->findAll();

        return $this->render('gericht/index.html.twig', [
            'gerichte' => $gerichte,
        ]);
    }
    /**
     * @Route("/anlegen", name="anlegen")
     */
    public function anlegen(Request $request,ManagerRegistry $doctrine) {
        
        $gericht = new Gericht();
        $form = $this->createForm(GerichtType::class, $gericht);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em = $doctrine->getManager();
            $bild = $request->files->get('gericht')['anhang'];
            
            if ($bild){
                $dateName = md5(uniqid()). '.'. $bild->guessClientExtension();
            }

            $bild->move(
                $this->getParameter('bilder_ordner'),
                $dateName
            );
            $gericht->setBild($dateName);

            $em->persist($gericht);
            $em->flush();

            return $this->redirect($this->generateUrl('gericht.bearbeiten'));
        }


        return $this->render('gericht/anlegen.html.twig', [
            'anlegenForm' => $form->createView(),
        ]);

    }
    /**
     * @Route("/entfernen/{id}", name="entfernen")
     */
    public function entfernen($id, GerichtRepository $gr,ManagerRegistry $doctrine){
        $gericht = new Gericht();
        $em = $doctrine->getManager();
        $gericht = $gr->find($id);
        $em->remove($gericht);
        $em->flush();
        $this->addFlash('erfolg','Geride deleted');
        return $this->redirect($this->generateUrl('gericht.bearbeiten'));
    }
    
    /**
     * @Route("/anzeigen/{id}", name="anzeigen")
     */
    public function anteigen(Gericht $gericht)
    {
        return $this->render('gericht/anzeigen.html.twig', [
            'gericht' => $gericht,
        ]);
        //dump($gericht);

    }
}
