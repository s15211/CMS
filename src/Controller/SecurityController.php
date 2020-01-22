<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistrationFormType;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();


        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            /** @var User $user */
            $user = $form->getData();
            dd($form->getData(),$user);
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $form['password']->getData()
            ));
            $user->setRoles(['ROLE_ADMIN']);
        }


        return $this->render('security/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'regForm' => $form->createView(),
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
}
