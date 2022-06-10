<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Serializer;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $roles=["ROLE_USER","ROLE_RP","ROLE_AC"];
        $plainPassword = 'cas@123';
        for ($i = 1; $i <=10; $i++) {
        $user = new User();
        $pos= rand(0,2);
        $user->setNomComplet('Nom et Prenom'.$i);
        $user->setEmail(strtolower($roles[$pos]).$i."@gmail.com");
        // $encoded = $this->encoder->hashPassword($user, $plainPassword);
        $user->setPassword($plainPassword);
        $user->setRoles([$roles[$pos]]);
        $manager->persist($user);
        $this->addReference("User".$i, $user);
    }

        $manager->flush();
    }
}
