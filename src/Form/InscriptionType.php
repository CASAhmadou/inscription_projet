<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('etudiant')
            ->add('classe')
            ->add('anneeScolaire')
        ;

        $builder
            ->add('libelle')
            ->add('niveau', ChoiceType::class, [
                'choices' => [
                        'Autre...' => '',
                        'Licence1' => 'L1',
                        'Licence2' => 'L2',
                        'Licence3' => 'L3',
                        'Master1' => 'M1',
                        'Master2' => 'M2',
                        'Doctorat' => 'Doct',
                        'required'=> false,
                    ],
                ])
            ->add('filliere', ChoiceType::class, [
                'choices' => Classe::$fillieres
            ])

            ->add('professeurs', EntityType::class, [
                'class' => Professeur::class,
                'multiple' => true,
                'expanded' => true,
            ])           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
