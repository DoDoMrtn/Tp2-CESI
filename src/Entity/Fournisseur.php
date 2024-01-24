<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur extends Personne
{
    #[ORM\Column]
    private ?int $NumFournisseur = null;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="entreprise")
     */
    private $produits;


    public function getNumFournisseur(): ?int
    {
        return $this->NumFournisseur;
    }

    public function setNumFournisseur(int $NumFournisseur): static
    {
        $this->NumFournisseur = $NumFournisseur;

        return $this;
    }

    public function getProduits(): ?Produit
    {
        return $this->produits;
    }

    public function setProduits(?Produit $produits): self
    {
        $this->produits = $produits;

        return $this;
    }
}
