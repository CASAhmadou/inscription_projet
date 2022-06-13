<?php

namespace App\DataFixtures;

use App\Entity\Rpd;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RpdFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager): void
    {
        // $roles=["ROLE_USER","ROLE_RP","ROLE_AC"];
        // $plainPassword = 'cas@123';
        // for ($i = 1; $i <=10; $i++) {
        // $user = new Rpd();
        // $user->setNomComplet('Nom et Prenom'.$i);
        // $user->setEmail('rpd'.$i."@gmail.com");
        // $encoded = $this->encoder->hashPassword($user, $plainPassword);
        // $user->setPassword($encoded);
        // $user->setRoles(['Role_Rpd']);
        // $manager->persist($user);
        // $this->addReference("User".$i, $user);
        // }
        $manager->flush();
    }
}
