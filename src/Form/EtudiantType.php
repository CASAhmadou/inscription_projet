<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet',TextType::class,[
                'required'=> false,
                'constraints'=>[new NotBlank()]
            ])
            ->add('adresse',TextType::class,[
                'required'=> false,
                'constraints'=>[new NotBlank()]
            ])
            ->add('sexe', ChoiceType::class, [
                'constraints'=>[new NotBlank()],
                'choices' =>  [
                    'Masculin' => 'M',
                    'Feminin' => 'F',
                ]
            ])
            // ->add('email')
            // ->add('roles')
            // ->add('password')
            // ->add('matricule')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
