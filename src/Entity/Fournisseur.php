<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $NumFournisseur = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $Produits = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumFournisseur(): ?int
    {
        return $this->NumFournisseur;
    }

    public function setNumFournisseur(int $NumFournisseur): static
    {
        $this->NumFournisseur = $NumFournisseur;

        return $this;
    }

    public function getProduits(): array
    {
        return $this->Produits;
    }

    public function setProduits(array $Produits): static
    {
        $this->Produits = $Produits;

        return $this;
    }
}
