<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController
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
        return new Response(sprintf(
            'Articles : %s',
            $id
        ));
    }
}