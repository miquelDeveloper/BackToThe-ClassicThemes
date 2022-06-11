<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/mail", name="mail")
     */
    public function sendEmail(MailerInterface $mailer, Request $request): Response
    {
        $emailForm = $this->createFormBuilder()
          ->add('nachright', TextareaType::class,[
              'attr' => array('rows', '5')
          ])
          ->add('abschicken', SubmitType::class,[
              'attr' => [
                  'class' => 'btn btn-outline-danger float-right'
              ]
          ])
          /* ->add('Enviar', SubmitType::class) */
          ->getForm();
        
        $emailForm->handleRequest($request);

        if($emailForm->isSubmitted()){
            $eingabe = $emailForm->getData();
            $text = ($eingabe['nachright']);
            $tisch = "tisch1";
            //$text = "portam la sal";
            $email = (new TemplatedEmail())
                ->from('dreamdoservices@gmail.com')
                ->to('regidormiquel@gmail.com')
                ->subject('Order bestellung template')
                ->text('extra pommes')
                ->htmlTemplate('mailer/mail.html.twig')
                ->context([
                    'tisch' => $tisch,
                    'text'  => $text
                ]);
            $mailer->send($email);
            $this->addFlash('nachricht','Nachright was sended');
            return $this->redirect($this->generateUrl('mail'));
    
            
        }

        return $this->render('mailer/index.html.twig',[
            'emailForm' => $emailForm->createView()
        ]);
    }
}
