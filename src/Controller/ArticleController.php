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
        return  $this->render('base.html.twig');
    }

    /**
     * @Route("/article/{id}")
     */
    public function article($id)
    {
        //dump($this);
        return $this->render('article/show.html.twig', [
        'tittle' => ucwords(str_replace('-',' ',$id)),
    ]);
    }
}