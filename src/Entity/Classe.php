<?php

namespace App\Entity;

use App\Entity\Rpd;
use App\Entity\Professeur;
use App\Entity\Inscription;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 25)]
    #[Assert\NotBlank(message:'le libelle ne doit pas etre vide')]
    private $libelle;

    #[ORM\Column(type: 'string', length: 25)]
    #[Assert\NotBlank(message:'veuillez choisir un niveau')]
    private $niveau;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBLank(message:'veuillez choisir une filiere')]
    private $filliere;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Inscription::class)]
    private $inscriptions;

    #[ORM\ManyToOne(targetEntity: Rpd::class, inversedBy: 'classes')]
    #[ORM\JoinColumn(nullable: true)]
    private $rpd;

    #[ORM\ManyToMany(targetEntity: Professeur::class, inversedBy: 'classes')]
    private $professeur;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->professeur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public static $fillieres = [
        'Choisir' => '','Dev Web'=>'Dev',
        'Ref Digital' => 'Ref', 
        'PHP' => 'php', 
        'JavaScript' => 'JS', 
        'Symfony' => 'Symf',
        'Java' => 'java',
        'Python' => 'python'
    ];

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getFilliere(): ?string
    {
        return $this->filliere;
    }

    public function setFilliere(string $filliere): self
    {
        $this->filliere = $filliere;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setClasse($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getClasse() === $this) {
                $inscription->setClasse(null);
            }
        }

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
        return $this->getLibelle();
    }
}
