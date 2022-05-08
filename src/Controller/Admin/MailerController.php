<?php

namespace App\Controller\Admin;

use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    
    #[Route('/Email')]
     
    public function sendEmail(MailerInterface $mailer, UserType $user)
    {
        $email = (new Email())
            ->from('deadlivery@gmail.com')
            ->to('maxime.lopez44@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

            try {
                $sent = $mailer->send($email);
            } catch (TransportExceptionInterface $e) {
                print $e->getDebug()."\n";            
                throw $e;
            }
            if ($sent) {
                $mailer->send($email);
            }            

        return $this->redirectToRoute('app_security_login');
    }
}
