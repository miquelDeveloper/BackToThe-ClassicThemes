<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="app_article")
     */
    public function index(ManagerRegistry $doctrine)
    {
        $article = new Article();
        $article->setTitle('article tietle 2');
        $em = $doctrine->getManager();
        
        //$em->persist($article);
        //$em->flush();
        $getArticle = $em->getRepository(Article::class)->findOneBy([
            'id' => 1
        ]);

        //return new Response("Article was created");
        return $this->render('article/index.html.twig', [
            'article' => $getArticle,
        ]);
    }
}
