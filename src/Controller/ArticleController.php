<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterFormType;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(Request $request, EntityManagerInterface $em)
    {
        $user = $this->getUser();
        if($user)
        {
            $last_username = $user->getUsername();
            $email = $user->GetEmail();
        }
        else
        {
            $last_username = null;
            $email = null;
        }
        if($user && $user->getNewsletter())
        {
            $news = $user->getNewsletter();
        }
        else
        {
            $news = null;
        }


        $form = $this->createForm(NewsletterFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $newletter = new Newsletter();
            $newletter->setEmail($data['email']);
            if($data['email'] == $email)
            {
                $newletter->setUser($user);
            }
            $em->persist($newletter);
            $em->flush();

            $this->addFlash('success','Email signed up !');
        }

        $marks = $this->askApi('marks');
        $body = $this->askApi('body_types');
        $engine = $this->askApi('engine_sizes');

        $search = $this->createForm(SearchType::class);
        $search->handleRequest($request);
        if($search->isSubmitted() && $search->isValid())
        {
            $data = $search->getData();
            return $this->redirectToRoute('app_search',['name' => $data['srchText'], 'mark' => $data['mark'], 'body' => $data['bodyType'], 'engine' => $data['engineSize']]);
        }


        return  $this->render('article/index.html.twig',[
            'marks' => $marks,
            'bodies' => $body,
            'engines' => $engine,
            'last_username' => $last_username,
            'email' => $email,
            'news' => $news,
            'newsForm' => $form->createView(),
            'searchForm' => $search->createView(),
        ]);
    }

    /**
     * @Route("/article/{id}", name="app_article")
     */
    public function article($id)
    {
        return $this->render('article/show.html.twig', [
        'tittle' => ucwords(str_replace('-',' ',$id)),
    ]);
    }

    /**
     * @Route("/articles/{name}/{mark}/{body}/{engine}", name="app_search")
     */
    public function search($name,$mark,$body,$engine)
    {
        dd($name,$mark,$body,$engine);
        return $this->render('article/carsList.html.twig', [
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