<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="app_main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController'
        ]);
        }
        
    /**
     * @Route("/starto/{name?}", name="starto")          
     */
    public function start(Request $request, $name){
        return new Response('<h1> Welkome '.$name.'</h1>');
    }
}
