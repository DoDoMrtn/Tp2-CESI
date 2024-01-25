<?php

namespace App\Entity;

use App\Repository\SalarieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SalarieRepository::class)]
class Salarie extends Personne
{
    #[ORM\Column]
    #[Assert\NotNull]
    private ?int $Matricule = null;

    #[ORM\Column(length: 5)]
    #[Assert\NotNull]
    private ?int $Departement = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    private ?string $Poste = null;

    #[ORM\Column]
    #[Assert\NotNull]
    #[Assert\GreaterThan(0)]
    private ?float $Salaire = null;

    #[ORM\ManyToOne(targetEntity: Personne::class)] // Spécifie la jointure avec l'entité Personne
    #[ORM\JoinColumn(name: "personne_id", referencedColumnName: "id")] // Utilise la colonne 'personne_id' pour la jointure
    private ?Personne $personne = null;

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

    public function getPersonne(): ?Personne
{
    return $this->personne;
}

public function setPersonne(?Personne $personne): self
{
    $this->personne = $personne;

    // assurez-vous que l'association est bidirectionnelle
    if ($personne !== null && $personne->getSalarie() !== $this) {
        $personne->setSalarie($this);
    }

    return $this;
}
}
