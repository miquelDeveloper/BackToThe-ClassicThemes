<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/mail", name="app_mail")
     */
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('dreamdoservices@gmail.com')
            ->to('regidormiquel@gmail.com')
            ->subject('Order bestellung')
            ->text('extra pommes');
        $mailer->send($email);

        return new Response('Email sended');
    }
}
