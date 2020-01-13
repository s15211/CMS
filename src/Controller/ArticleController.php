<?php

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(\Swift_Mailer $mailer)
    {
        $marks = $this->askApi('marks');
        $body = $this->askApi('body_types');
        $engine = $this->askApi('engine_sizes');
        /*
        $message = (new \Swift_Message('Aktywuj konto!'))
            ->setFrom('driven3twork@gmail.com')
            ->setTo('s15211@pjwstk.edu.pl')
            ->setBody('Kod aktywacji konta to : xxxxxxx');
        $mailer->send($message);
        */
        return  $this->render('article/index.html.twig',[
            'marks' => $marks,
            'bodies' => $body,
            'engines' => $engine
        ]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login()
    {
        return  $this->render('article/login.html.twig');
    }

    /**
     * @Route("/article/{id}", name="app_article")
     */
    public function article($id)
    {
        //dump($this);
        return $this->render('article/show.html.twig', [
        'tittle' => ucwords(str_replace('-',' ',$id)),
    ]);
    }

    public function askApi($table)
    {
        $client = HttpClient::create();
        $respone = $client->request('GET','http://localhost:8080/api/'.$table);
        $body = $respone->getContent();
        $data = json_decode($body,true);
        $data = $data['hydra:member'];
        return $data;
    }
}