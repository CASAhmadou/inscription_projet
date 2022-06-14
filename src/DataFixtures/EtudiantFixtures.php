<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EtudiantFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager): void
    {
        $plainPassword = 'cas@123';
        for ($i = 1; $i <=15; $i++) {
        $user = new Etudiant();
        $user->setNomComplet('Nom et Prenom'.$i);
        $user->setEmail('etudiant'.$i."@gmail.com");
        $user->setMatricule('SN00'.$i);
        $encoded = $this->encoder->hashPassword($user, $plainPassword);
        $user->setPassword($encoded);
        $user->setRoles(['Role_Etudiant']);
        $manager->persist($user);

        $this->addReference("User".$i, $user);
        }
        $manager->flush();
    }
}
