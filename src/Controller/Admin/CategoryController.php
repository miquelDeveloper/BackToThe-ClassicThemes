<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


    /**
     * @Route("/admin/category", name="app_admin_category")
     */
class CategoryController extends AbstractController
{
    private $security;
    private $user;
    private $hasAccess;
    public function __construct(Security $security)
    {   
        $this->security = $security;
        $this->user = $this->security->getUser();
        $this->hasAccess = in_array('ROLE_ADMIN', $this->user->getRoles());
        //$this->adminRole = array_search('ROLE_ADMIN',$this->user->getRoles()) ?? false;

        
    }
    
    /**
     * @Route("/", name="list_categories")
     */
    public function index(CategoryRepository $cr): Response
    {
        if($this->hasAccess){
            $listOf = $cr->findAll();
            return $this->render('admin/category/index.html.twig', [
                'Category_controller' => 'CategoryController',
                'list' => $listOf
            ]);
        }else{
            $this->addFlash('user_messages', ' Can\'t access admin area ');
            return $this->redirect($this->generateUrl('home'));
        } 
    }
    /**
     * @Route("/", name="add_category")
            */
            public function add(Request $request,ManagerRegistry $doctrine){
        $category = new Category();

    }
}
