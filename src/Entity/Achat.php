<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManagerInterface;
use App\Exceptions\ErreurTransactionAchatException;

#[ORM\Entity(repositoryClass: AchatRepository::class)]
class Achat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $NumAchat = null;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class)
     * @ORM\JoinTable(name="achats_produits",
     *      joinColumns={@ORM\JoinColumn(name="achat_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="produit_id", referencedColumnName="id")}
     *      )
     */
    private $produits;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="achats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DataAchat = null;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumAchat(): ?int
    {
        return $this->NumAchat;
    }

    public function setNumAchat(int $NumAchat): static
    {
        $this->NumAchat = $NumAchat;

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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getDataAchat(): ?\DateTimeInterface
    {
        return $this->DataAchat;
    }

    public function setDataAchat(\DateTimeInterface $DataAchat): static
    {
        $this->DataAchat = $DataAchat;

        return $this;
    }

    public function effectuerTransactionAchat(): void
    {
        try {
            // Logique pour effectuer la transaction

            // Obtenez le dernier numéro d'achat depuis la base de données
            $dernierNumeroAchat = $this->entityManager->getRepository(Achat::class)->findDernierNumeroAchat();

            // Incrémentez le dernier numéro d'achat pour obtenir le nouveau numéro
            $nouveauNumeroAchat = $dernierNumeroAchat + 1;

            // Associez le nouveau numéro d'achat à la transaction
            $this->setNumAchat($nouveauNumeroAchat);

            // Associez les produits à la transaction d'achat
            foreach ($this->produits as $produit) {
                $produit->setAchats($this);
            }

            // Associez le client à la transaction d'achat
            $this->client->addAchat($this);

            // Persistez les changements dans la base de données
            $this->entityManager->persist($this);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            // Si une erreur se produit, lancez l'exception appropriée
            throw new ErreurTransactionAchatException("Erreur lors de la transaction d'achat.", 0, $e);
        }
    }
}
