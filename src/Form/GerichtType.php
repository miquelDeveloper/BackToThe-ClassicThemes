<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Gericht;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GerichtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('anhang', FileType::class, ['mapped' => false])
            ->add('beschreibung')
            ->add('categorie', EntityType::class,[
                'class' => Categorie::class
            ])
            ->add('preis')
            ->add('Save', SubmitType::class)
        ;   
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gericht::class,
        ]);
    }
}