<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchatRepository::class)]
class Achat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $NumAchat = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $ProduitsAchetes = [];

    #[ORM\Column(length: 255)]
    private ?string $Client = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DataAchat = null;

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

    public function getProduitsAchetes(): array
    {
        return $this->ProduitsAchetes;
    }

    public function setProduitsAchetes(array $ProduitsAchetes): static
    {
        $this->ProduitsAchetes = $ProduitsAchetes;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->Client;
    }

    public function setClient(string $Client): static
    {
        $this->Client = $Client;

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
}
