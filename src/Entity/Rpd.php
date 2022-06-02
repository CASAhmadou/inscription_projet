<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RpdRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#Entity
#[ORM\Entity(repositoryClass: RpdRepository::class)]
class Rpd extends User
{
    #[ORM\OneToMany(mappedBy: 'rpd', targetEntity: Demande::class)]
    private $demandes;

    #[ORM\OneToMany(mappedBy: 'rpd', targetEntity: Classe::class)]
    private $classes;

    #[ORM\OneToMany(mappedBy: 'rpd', targetEntity: Module::class)]
    private $modules;

    #[ORM\OneToMany(mappedBy: 'rpd', targetEntity: Professeur::class)]
    private $professeurs;

    public function __construct()
    {
        $this->demandes = new ArrayCollection();
        $this->classes = new ArrayCollection();
        $this->modules = new ArrayCollection();
        $this->professeurs = new ArrayCollection();
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes[] = $demande;
            $demande->setRpd($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getRpd() === $this) {
                $demande->setRpd(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
            $class->setRpd($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getRpd() === $this) {
                $class->setRpd(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Module>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules[] = $module;
            $module->setRpd($this);
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        if ($this->modules->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getRpd() === $this) {
                $module->setRpd(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs[] = $professeur;
            $professeur->setRpd($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        if ($this->professeurs->removeElement($professeur)) {
            // set the owning side to null (unless already changed)
            if ($professeur->getRpd() === $this) {
                $professeur->setRpd(null);
            }
        }

        return $this;
    }
}
