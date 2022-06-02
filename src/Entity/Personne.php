<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
#InheritanceType("JOINED")
#DiscriminatorColumn(name="discr", type="string")
#DiscriminatorMap({"person" = "Person", "user" = "User", "professeur" = "Professeur", "attache" = "Attache", "etudiant" = "Etudiant", "rpd" = "Rpd"})

class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomComplet;

    #[ORM\Column(type: 'string', length: 50,nullable: true)]
    private $adresse;

    #[ORM\Column(type: 'string', length: 10,nullable: true)]
    private $sexe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomComplet(): ?string
    {
        return $this->nomComplet;
    }

    public function setNomComplet(string $nomComplet): self
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }
}
