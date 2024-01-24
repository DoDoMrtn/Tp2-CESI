<?php

namespace App\Entity;

use App\Repository\SalarieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalarieRepository::class)]
class Salarie extends Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Matricule = null;

    #[ORM\Column]
    private ?int $Departement = null;

    #[ORM\Column(length: 255)]
    private ?string $Poste = null;

    #[ORM\Column]
    private ?float $Salaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?int
    {
        return $this->Matricule;
    }

    public function setMatricule(int $Matricule): static
    {
        $this->Matricule = $Matricule;

        return $this;
    }

    public function getDepartement(): ?int
    {
        return $this->Departement;
    }

    public function setDepartement(int $Departement): static
    {
        $this->Departement = $Departement;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->Poste;
    }

    public function setPoste(string $Poste): static
    {
        $this->Poste = $Poste;

        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->Salaire;
    }

    public function setSalaire(float $Salaire): static
    {
        $this->Salaire = $Salaire;

        return $this;
    }
}
