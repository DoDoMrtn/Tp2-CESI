<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client extends Personne
{

    #[ORM\Column]
    private ?int $NumClient = null;

    /**
     * @ORM\OneToMany(targetEntity=Achat::class, mappedBy="client")
     */
    private $achats;


    public function getNumClient(): ?int
    {
        return $this->NumClient;
    }

    public function setNumClient(int $NumClient): static
    {
        $this->NumClient = $NumClient;

        return $this;
    }

    public function getAchat(): ?Achat
    {
        return $this->achats;
    }

    public function setAchat(?Achat $achats): self
    {
        $this->achats = $achats;

        return $this;
    }

    public function addAchat(Achat $achat): self
    {
        if (!$this->achats->contains($achat)) {
            $this->achats[] = $achat;
            $achat->setClient($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achats->removeElement($achat)) {
            // set the owning side to null (unless already changed)
            if ($achat->getClient() === $this) {
                $achat->setClient(null);
            }
        }

        return $this;
    }
}
