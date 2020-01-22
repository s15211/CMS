<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistrationFormType;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils,Request $request,UserPasswordEncoderInterface $passwordEncoder)
    {
        $marks = $this->askApi('marks');
        $body = $this->askApi('body_types');

        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            dd($form->getData());
            /** @var User $user */
            $user = $form->getData();
            dd($form->getData(),$user);
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $form['password']->getData()
            ));
            $user->setRoles(['ROLE_ADMIN']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
        else
        {
            $error = $authenticationUtils->getLastAuthenticationError();
            $lastUsername = $authenticationUtils->getLastUsername();
        }



        return $this->render('security/index.html.twig', [
            'last_username' => $lastUsername,
            'marks' => $marks,
            'bodies' => $body,
            'error' => $error,
            'regForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request,UserPasswordEncoderInterface $passwordEncoder)
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
        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            /** @var User $user */
            $user = $form->getData();
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $form['password']->getData()
            ));
            $user->setRoles(['ROLE_USERS']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->redirectToRoute('app_homepage');

        return $this->render('security/index.html.twig', [
            'last_username' => $last_username,
            'error' => null,
            'marks' => $this->askApi('marks'),
            'bodies' => $this->askApi('body_types'),
            'regForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     * Is_Granted('ROLE_USER')
     */
    public function logout()
    {
        throw new Exception('Logout failed. . .');
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
