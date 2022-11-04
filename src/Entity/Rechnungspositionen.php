<?php

namespace App\Entity;

use App\Repository\RechnungspositionenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RechnungspositionenRepository::class)]
class Rechnungspositionen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $EZPreisNetto = null;

    #[ORM\Column(length: 255)]
    private ?string $mwst = null;

    #[ORM\ManyToOne(inversedBy: 'Rechnungsposition')]
    private ?Rechnung $rechnung = null;



    public function __construct()
    {
        $this->Rechnung = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEZPreisNetto(): ?int
    {
        return $this->EZPreisNetto;
    }

    public function setEZPreisNetto(int $EZPreisNetto): self
    {
        $this->EZPreisNetto = $EZPreisNetto;

        return $this;
    }

    public function getMwst(): ?string
    {
        return $this->mwst;
    }

    public function setMwst(string $mwst): self
    {
        $this->mwst = $mwst;

        return $this;
    }

    /**
     * @return Collection<int, Rechnung>
     */
    public function getRechnung(): Collection
    {
        return $this->Rechnung;
    }

    public function addRechnung(Rechnung $rechnung): self
    {
        if (!$this->Rechnung->contains($rechnung)) {
            $this->Rechnung->add($rechnung);
            $rechnung->setRechnungsposition($this);
        }

        return $this;
    }

    public function removeRechnung(Rechnung $rechnung): self
    {
        if ($this->Rechnung->removeElement($rechnung)) {
            // set the owning side to null (unless already changed)
            if ($rechnung->getRechnungsposition() === $this) {
                $rechnung->setRechnungsposition(null);
            }
        }

        return $this;
    }

    public function setRechnung(?Rechnung $rechnung): self
    {
        $this->rechnung = $rechnung;

        return $this;
    }
}
