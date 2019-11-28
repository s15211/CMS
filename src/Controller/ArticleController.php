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
    public function homepage(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Aktywuj konto!'))
            ->setFrom('driven3twork@gmail.com')
            ->setTo('s15211@pjwstk.edu.pl')
            ->setBody('Kod aktywacji konta to : xxxxxxx');
        $mailer->send($message);
        return  $this->render('article/index.html.twig');
    }

    /**
     * @Route("/contact")
     */
    public function contact()
    {
        return  $this->render('article/contact.html.twig.html.twig');
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