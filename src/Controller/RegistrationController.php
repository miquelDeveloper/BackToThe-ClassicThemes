<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/reg", name="reg")
     */
    public function reg(Request $request, UserPasswordEncoderInterface $passEncoder, ManagerRegistry $doctrine): Response
    {
        $regform = $this->createFormBuilder()
            ->add('username', TextType::class,[
                'label' => 'Mitarbeiter'])
            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => ['label' => 'password'],
                'second_options' => ['label' => 'Repite password']
            ])
            
            ->add('registry', SubmitType::class)
            ->getForm();
        
        $regform->handleRequest($request);

        if ( $regform->isSubmitted()){ 
            $formData = $regform->getData();
            $user = new User();
            $user->setUsername($formData['username']);

            $user->setPassword(
                $passEncoder->encodePassword($user, $formData['password'])
            );

            $em = $doctrine->getManager();
            $em->persist($user);
            $em->flush();
            dump($formData);
            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('registration/index.html.twig', [
            'regform' => $regform->createView()
        ]);
    }
}
