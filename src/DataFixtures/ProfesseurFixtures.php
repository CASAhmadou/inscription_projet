<?php

namespace App\DataFixtures;

use App\Entity\Module;
use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfesseurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
               
        $grade=["MASTER","INGENIEUR","DOCTEUR"];
        $sexes=["M","F"];
        for ($i=0; $i < 10; $i++) { 
            $prof= new Professeur();
            $sex=rand(0,1);
            $rand=rand(0,2);
            $prof->setNomComplet('prof'.$i);
            $prof->setGrade($grade[$rand]);
            $prof->setSexe($sexes[$sex]); 

            for ($j=0; $j < 2; $j++) { 
                $ref=rand(0,9);
                $prof->addClass($this->getReference('classe'.$ref));
            }
            // foreach ($modules as  $module) {
            //         $addModule = new Module;
            //         $addModule->setNomModule($module);
            //         $prof->addModule($addModule);
                
            //  }
            $manager->persist($prof);
        }
        $manager->flush();
    }
}
