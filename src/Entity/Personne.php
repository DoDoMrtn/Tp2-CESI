<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PersonneRepository::class)]
/**
 * @ORM\MappedSuperclass
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"personne" = "Personne", "salarie" = "Salarie"})
 */
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    protected ?string $Nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    protected ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    protected ?string $Adresse = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    protected ?string $Tel = null;

    #[ORM\OneToOne(targetEntity: Salarie::class, mappedBy: 'personne', cascade: ['persist', 'remove'])]
    private ?Salarie $salarie = null;

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

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

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

    public function getTel(): ?string
    {
        return $this->Tel;
    }

    public function setTel(string $Tel): static
    {
        $this->Tel = $Tel;

        return $this;
    }

    public function getSalarie(): ?Salarie
{
    return $this->salarie;
}

public function setSalarie(?Salarie $salarie): self
{
    $this->salarie = $salarie;

    // assurez-vous que l'association est bidirectionnelle
    if ($salarie !== null && $salarie->getPersonne() !== $this) {
        $salarie->setPersonne($this);
    }

    return $this;
}
}
