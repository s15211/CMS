<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Newsletter;
use App\Entity\Post;
use App\Form\ContactForm;
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

        $posts = $this->getDoctrine()
            ->getRepository(Post::class)->findMaxId();


        $post1 = $this->getDoctrine()
            ->getRepository(Post::class)->find($posts[0]->getId());

        $post2 = $this->getDoctrine()
            ->getRepository(Post::class)->find($posts[1]->getId());

        $post3 = $this->getDoctrine()
            ->getRepository(Post::class)->find($posts[2]->getId());

        $post4 = $this->getDoctrine()
            ->getRepository(Post::class)->find($posts[3]->getId());

        $post5 = $this->getDoctrine()
            ->getRepository(Post::class)->find($posts[4]->getId());

        $post6 = $this->getDoctrine()
            ->getRepository(Post::class)->find($posts[5]->getId());

        $post7 = $this->getDoctrine()
            ->getRepository(Post::class)->find($posts[6]->getId());

        $post8 = $this->getDoctrine()
            ->getRepository(Post::class)->find($posts[7]->getId());

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
            'name1' => $post1->getCar(),
            'image1' => $post1->getThumbnail(),
            'user1' => $post1->getUser(),
            'title1' => $post1->getTitle(),
            'name2' => $post2->getCar(),
            'image2' => $post2->getThumbnail(),
            'user2' => $post2->getUser(),
            'title2' => $post2->getTitle(),
            'image3' => $post3->getThumbnail(),
            'name3' => $post3->getCar(),
            'name4' => $post4->getCar(),
            'name5' => $post5->getCar(),
            'name6' => $post6->getCar(),
            'name7' => $post7->getCar(),
            'name8' => $post8->getCar(),
            'image4' => $post4->getThumbnail(),
            'image5' => $post5->getThumbnail(),
            'image6' => $post6->getThumbnail(),
            'image7' => $post7->getThumbnail(),
            'image8' => $post8->getThumbnail(),
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

        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->find($id);

        $marks = $this->askApi('marks');
        $body = $this->askApi('body_types');

        return $this->render('article/carDetail.html.twig', [
            'title' => $post->getTitle(),
            'username' => $post->getUser(),
            'marks' => $marks,
            'bodies' => $body,
            'last_username' => $last_username,
            'email' => $email,
            'date' => $post->getDate(),
            'lead' => $post->getCar()->GetName(),
            'image' => $post->getThumbnailFile(),
            'content' => $post->getContent()
    ]);
    }

    /**
     * @Route("/{table}/{id}", name="app_quick")
     */
    public function quick($table,$id,EntityManagerInterface $em)
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
        $repoCar = $em->getRepository(Car::class);
        if($table == 'mark')
            $cars = $repoCar->findByExampleField(0,$id,0,0);
        else
            $cars = $repoCar->findByExampleField(0,0,$id,0);


        $repoPost = $em->getRepository(Post::class);
        $posts = $repoPost->findByExampleField($cars);

        return $this->render('article/carsList.html.twig', [
            'marks' => $this->askApi('marks'),
            'bodies' => $this->askApi('body_types'),
            'last_username' => $last_username,
            'email' => $email,
            'post' => $posts,
        ]);
    }

    /**
     * @Route("/articles/{name}/{mark}/{body}/{engine}", name="app_search")
     */
    public function search($name,$mark,$body,$engine,EntityManagerInterface $em)
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

        $repoCar = $em->getRepository(Car::class);
        $cars = $repoCar->findByExampleField($name,$mark,$body,$engine);

        $repoPost = $em->getRepository(Post::class);
        $posts = $repoPost->findByExampleField($cars);


        return $this->render('article/carsList.html.twig', [
            'marks' => $this->askApi('marks'),
            'bodies' => $this->askApi('body_types'),
            'last_username' => $last_username,
            'email' => $email,
            'post' => $posts,
        ]);
    }

    /**
     * @Route("/contact", name="app_contact")
     */
    public function contact(Request $request,\Swift_Mailer $mailer)
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

        $form = $this->createForm(ContactForm::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->sendMail($form['email']->getData(),$form['subject']->getData(),$form['content']->getData(), $mailer);
            $this->addFlash('success','Email send !');
        }

        return $this->render('article/contact.html.twig',[
            'marks' => $this->askApi('marks'),
            'bodies' => $this->askApi('body_types'),
            'last_username' => $last_username,
            'form' => $form->createView()
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

    public function sendMail($email,$subject,$content, \Swift_Mailer $mailer)
    {

        $message = (new \Swift_Message('Contact Us - Drive Network'))
            ->setFrom('driven3twork@gmail.com')
            ->setTo('driven3twork@gmail.com')
            ->setBody($this->renderView(
                'Email/contactUs.html.twig',[
                    'email' => $email,
                    'subject' => $subject,
                    'content' => $content
                ]
            ));
        $mailer->send($message);

    }
}