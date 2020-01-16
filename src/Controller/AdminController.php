<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function admin()
    {
        return $this->json(['ok']);
    }

    public function sendMail($email, \Swift_Mailer $mailer)
    {

        $message = (new \Swift_Message('Newsletter - Drive Network'))
            ->setFrom('driven3twork@gmail.com')
            ->setTo($email)
            ->setBody('Tutaj kreacja HTML');
        $mailer->send($message);

    }
}
