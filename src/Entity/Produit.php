<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\IVendable;
use Doctrine\ORM\EntityManagerInterface;
use App\Exceptions\ProduitDejaExistanteException;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit implements IVendable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Reference = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column]
    private ?float $Prix = null;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fournisseur;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?int
    {
        return $this->Reference;
    }

    public function setReference(int $Reference): static
    {
        $this->Reference = $Reference;

        return $this;
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

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        // Ajoutez le produit à la collection du fournisseur
        if ($fournisseur) {
            $fournisseur->addProduit($this);
        }

        return $this;
    }

    public function vendre()
    {
       // Ajoutez ici la logique spécifique à la vente du produit
        // Par exemple, mettez à jour le stock, générez une facture, etc.

        // Pour cet exemple, affichons simplement un message
        echo "Le produit {$this->getNom()} a été vendu.\n";
    }

    private function produitExisteDeja(): bool
    {
        // Vérifiez si le produit existe déjà dans la base de données
        $produitRepository = $this->entityManager->getRepository(Produit::class);

        // Supposons que vous vérifiez l'existence du produit par son identifiant (ID)
        $produitExistant = $produitRepository->findOneBy(['id' => $this->id]);

        return $produitExistant !== null;
    }

    public function ajouterProduit(): void
    {
        // Vérifiez si le produit existe déjà
        if ($this->produitExisteDeja()) {
            throw new ProduitDejaExistanteException("Le produit existe déjà.");
        }

        // Logique pour ajouter le produit
        // Supposons que vous utilisez Doctrine ORM pour gérer la persistance
        $this->entityManager->persist($this);
        $this->entityManager->flush();
    }
}
