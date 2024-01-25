<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    private ?string $Nom = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?int $Siret = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    private ?string $Adresse = null;

    /**
     * @ORM\OneToMany(targetEntity=Salarie::class, mappedBy="entreprise")
     */
    private $salaries;

    /**
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="entreprise")
     */
    private $clients;

    /**
     * @ORM\OneToMany(targetEntity=Fournisseur::class, mappedBy="entreprise")
     */
    private $fournisseurs;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="entreprise")
     */
    private $produits;

    /**
     * @ORM\OneToMany(targetEntity=Achat::class, mappedBy="entreprise")
     */
    private $achats;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getSiret(): ?int
    {
        return $this->Siret;
    }

    public function setSiret(int $Siret): static
    {
        $this->Siret = $Siret;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getSalaries(): ?Salarie
    {
        return $this->salaries;
    }

    public function setsalaries(?Salarie $salaries): self
    {
        $this->salaries = $salaries;

        return $this;
    }

    public function getClients(): ?Client
    {
        return $this->clients;
    }

    public function setClients(?Client $clients): self
    {
        $this->clients = $clients;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseurs;
    }

    public function setFournisseur(?Fournisseur $fournisseurs): self
    {
        $this->fournisseurs = $fournisseurs;

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

    public function getAchats(): ?Achat
    {
        return $this->achats;
    }

    public function setAchats(?Achat $achats): self
    {
        $this->achats = $achats;

        return $this;
    }
}
