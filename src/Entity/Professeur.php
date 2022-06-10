<?php

namespace App\Entity;

use App\Entity\Personne;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProfesseurRepository;


#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
class Professeur extends Personne
{
    
    #[ORM\Column(type: 'string', length: 25)]
    private $grade;

    #[ORM\ManyToMany(targetEntity: Classe::class, mappedBy: 'professeur')]
    private $classes;

    #[ORM\ManyToMany(targetEntity: Module::class, mappedBy: 'professeur')]
    private $modules;

    #[ORM\ManyToOne(targetEntity: Rpd::class, inversedBy: 'professeurs')]
    #[ORM\JoinColumn(nullable: true)]
    private $rpd;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
        $this->modules = new ArrayCollection();
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

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
            $class->addProfesseur($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            $class->removeProfesseur($this);
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
            $module->addProfesseur($this);
        }

        return $this;
    }

    public function removeModule(Module $module): self
    {
        if ($this->modules->removeElement($module)) {
            $module->removeProfesseur($this);
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
    public function __toString()
    {
        return $this->getNomComplet();
    }
}



// $builder
// ->add('libelle')
// ->add('niveau', ChoiceType::class, [
//     'choices' => [
//             'Autre...' => '',
//             'Licence1' => 'L1',
//             'Licence2' => 'L2',
//             'Licence3' => 'L3',
//             'Master1' => 'M1',
//             'Master2' => 'M2',
//             'Doctorat' => 'Doct',
//             'required'=> false,
//         ],
//     ])
// ->add('filliere', ChoiceType::class, [
//     'choices' => Classe::$fillieres
// ])

// ->add('professeurs', EntityType::class, [
//     'class' => Professeur::class,
//     'multiple' => true,
//     'expanded' => true,
// ])


// ;