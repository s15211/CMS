<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return  new Response('homepage');
    }

    /**
     * @Route("/article/{id}")
     */
    public function article($id)
    {
        return $this->render('article/show.html.twig', [
        'tittle' => ucwords(str_replace('-',' ',$id)),
    ]);
    }
}