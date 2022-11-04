<?php

namespace App\Entity;

use App\Repository\ProduktRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduktRepository::class)]
class Produkt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $EZPreisNetto = null;

    #[ORM\Column]
    private ?int $lagerbestand = null;

    #[ORM\Column]
    private ?int $mwst = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $info = null;



    public function __construct()
    {
        $this->rechnung = new ArrayCollection();
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

    public function getLagerbestand(): ?int
    {
        return $this->lagerbestand;
    }

    public function setLagerbestand(int $lagerbestand): self
    {
        $this->lagerbestand = $lagerbestand;

        return $this;
    }

    public function getMwst(): ?int
    {
        return $this->mwst;
    }

    public function setMwst(int $mwst): self
    {
        $this->mwst = $mwst;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(?string $info): self
    {
        $this->info = $info;

        return $this;
    }

    /**
     * @return Collection<int, Rechnung>
     */
    public function getRechnung(): Collection
    {
        return $this->rechnung;
    }

    public function addRechnung(Rechnung $rechnung): self
    {
        if (!$this->rechnung->contains($rechnung)) {
            $this->rechnung->add($rechnung);
            $rechnung->setLeistung($this);
        }

        return $this;
    }

    public function removeRechnung(Rechnung $rechnung): self
    {
        if ($this->rechnung->removeElement($rechnung)) {
            // set the owning side to null (unless already changed)
            if ($rechnung->getLeistung() === $this) {
                $rechnung->setLeistung(null);
            }
        }

        return $this;
    }
}
