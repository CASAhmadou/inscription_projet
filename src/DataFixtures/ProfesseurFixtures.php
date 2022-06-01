<?php

namespace App\DataFixtures;

use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfesseurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $grade=["MASTER","INGENIEUR","DOCTEUR"];
        for ($i=0; $i < 10; $i++) { 
            $prof= new Professeur();
            $pos=rand(0,2);
            $prof->setNomComplet('prof'.$i);
            $prof->setGrade($grade[$pos]);
            for ($j=0; $j < 2; $j++) { 
                $ref=rand(0,9);
                $prof->addClass($this->getReference('classe'.$ref));
            }
            $manager->persist($prof);
        }
        $manager->flush();
    }
}
