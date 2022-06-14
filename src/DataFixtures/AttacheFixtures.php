<?php

namespace App\DataFixtures;

use App\Entity\Attache;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AttacheFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager): void
    {
       
       // $roles=["ROLE_USER","ROLE_RP","ROLE_AC"];
        // $plainPassword = 'ac@123';
        // for ($i = 1; $i <=5; $i++) {
        // $user = new Attache();
        // $user->setNomComplet('Nom et Prenom'.$i);
        // $user->setEmail('ac'.$i."@gmail.com");
        // $encoded = $this->encoder->hashPassword($user, $plainPassword);
        // $user->setPassword($encoded);
        // $user->setRoles(['Role_Attache']);
        // $manager->persist($user);
        // $this->addReference("User".$i, $user);
        // }
        $manager->flush();
    }
}
