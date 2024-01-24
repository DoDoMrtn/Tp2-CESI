<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $NumClient = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $HistoAchat = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumClient(): ?int
    {
        return $this->NumClient;
    }

    public function setNumClient(int $NumClient): static
    {
        $this->NumClient = $NumClient;

        return $this;
    }

    public function getHistoAchat(): array
    {
        return $this->HistoAchat;
    }

    public function setHistoAchat(array $HistoAchat): static
    {
        $this->HistoAchat = $HistoAchat;

        return $this;
    }
}
