<?php

namespace App\DataFixtures;

use App\Entity\Attache;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AttacheFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
        $manager->flush();
    }
}
