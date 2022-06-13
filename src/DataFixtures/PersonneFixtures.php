<?php

namespace App\DataFixtures;

use App\Entity\Personne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PersonneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // for ($i=0; $i < 10; $i++) { 
        //     $prof= new Personne();
        //     $prof->setNomComplet('Nom Prenom'.$i)
        //         ->setSexe('Sexe'.$i)
        //         ->setAdresse('Ville'.$i);
        //     $manager->persist($prof);
        // }
        $manager->flush();
    }
}
