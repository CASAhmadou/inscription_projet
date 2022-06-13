<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfesseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet')
            ->add('grade', ChoiceType::class, [
                'choices' => [
                    'Docteur' => 'doct',
                    'Doyen' => 'doy',
                    'Ingénieur' => 'ing'    
                ],
            ])
            // ->add('adresse')
            // ->add('sexe')
            // ->add('classes')
             ->add('classes', EntityType::class, [
                 'class'=> Classe::class,
                 'multiple'=>true,
                 'expanded'=>true
             ])
            // ->add('modules')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
