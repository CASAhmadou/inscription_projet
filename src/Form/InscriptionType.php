<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Entity\Inscription;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('anneeScolaire')
        
        ->add('etudiant', EtudiantType::class)

        ->add('etudiant',CollectionType::class,[
            'entry_type' => EtudiantType::class,
            'entry_options' => ['label' => false],
        ])

        ->add('classe')
        ;
        //->add('libelle');

        // $builder
        //     
        //     ->add('niveau', ChoiceType::class, [
        //         'choices' => [
        //                 'Autre...' => '',
        //                 'Licence1' => 'L 1',
        //                 'Licence2' => 'L2',
        //                 'Licence3' => 'L3',
        //                 'Master1' => 'M1',
        //                 'Master2' => 'M2',
        //                 'Doctorat' => 'Doct',
        //                 'required'=> false,
        //             ],
        //         ])
        //     ->add('filliere', ChoiceType::class, [
        //         'choices' => Classe::$fillieres
        //     ]);

        //              
        // ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
