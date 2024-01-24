<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur extends Personne
{
    #[ORM\Column]
    private ?int $NumFournisseur = null;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="fournisseur")
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
        return $this->produits ;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setFournisseur($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // définir le propriétaire du côté "fournisseur" à null
            if ($produit->getFournisseur() === $this) {
                $produit->setFournisseur(null);
            }
        }

        return $this;
    }
}
