<?php

namespace App\DataFixtures;

use App\Entity\Module;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ModuleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $modules = ['PHP','Java','html','css','JS'];
        for ($i = 1; $i <=10; $i++) {
            $module = new Module();
            $rand=rand(0,4);
            $module->setNomModule($modules[$rand]);
            $manager->persist($module);
            $this->addReference("Module".$i, $module);
            }

        $manager->flush();
    }
}
