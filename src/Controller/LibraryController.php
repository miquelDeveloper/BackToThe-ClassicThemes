<?php 
namespace App\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LibraryController extends AbstractController
{

/*     private $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        
    } */
    /**
     * @Route("/library/list", name="library_list")
     * 
     */
    public function list(Request $request){
        $title = $request->get('title');
        $response = new Response();
        $response->setContent('<div>Hola Mundo</div>');
        return $response;
    }

    /**
     * @Route("/library/listotra", name="library_list_otra")
     * 
     */
    public function listotra(Request $request,LoggerInterface $logger){
        $title = $request->get('title');
        $logger->info('List called to!!');
        $response = new JsonResponse();
        $response->setData([
            'succes' => true,
            'data' => [
                [
                    'id' => 1,
                    'title' => 'SoftWebDev'
                ],
                [
                    'id' => 2,
                    'title' => 'Assestment'
                ],
                [
                    'id' => 3,
                    'title' => $title
                ]
            ]
        ]);
        return $response;
    }
    
}
