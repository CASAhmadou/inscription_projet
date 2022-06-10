<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nomModule;

    #[ORM\ManyToOne(targetEntity: Rpd::class, inversedBy: 'modules')]
    #[ORM\JoinColumn(nullable: true)]
    private $rpd;

    #[ORM\ManyToMany(targetEntity: Professeur::class, inversedBy: 'modules')]
    private $professeur;


    public function __construct()
    {
        $this->professeur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomModule(): ?string
    {
        return $this->nomModule;
    }

    public function setNomModule(string $nomModule): self
    {
        $this->nomModule = $nomModule;

        return $this;
    }

    public function getRpd(): ?Rpd
    {
        return $this->rpd;
    }

    public function setRpd(?Rpd $rpd): self
    {
        $this->rpd = $rpd;

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseur(): Collection
    {
        return $this->professeur;
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->professeur->contains($professeur)) {
            $this->professeur[] = $professeur;
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        $this->professeur->removeElement($professeur);

        return $this;
    }
    public function __toString()
    {
        return $this->getNomModule();
    }

}
