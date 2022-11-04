<?php

namespace App\Entity;

use App\Repository\RechnungRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RechnungRepository::class)]
class Rechnung
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $menge = null;

    #[ORM\Column]
    private ?int $nettopreis = null;


    #[ORM\ManyToOne(inversedBy: 'rechnung')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Kunden $kunde = null;


    #[ORM\OneToMany(mappedBy: 'rechnung', targetEntity: Rechnungspositionen::class)]
    private Collection $Rechnungsposition;


    public function __construct()
    {
        $this->produkts = new ArrayCollection();
        $this->Rechnungsposition = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRechnungsnummer(): ?int
    {
        return $this->rechnungsnummer;
    }

    public function setRechnungsnummer(int $rechnungsnummer): self
    {
        $this->rechnungsnummer = $rechnungsnummer;

        return $this;
    }

    public function getLeistung(): ?string
    {
        return $this->leistung;
    }

    public function setLeistung(?string $leistung): self
    {
        $this->leistung = $leistung;

        return $this;
    }

    public function getMenge(): ?int
    {
        return $this->menge;
    }

    public function setMenge(int $menge): self
    {
        $this->menge = $menge;

        return $this;
    }

    public function getNettopreis(): ?int
    {
        return $this->nettopreis;
    }

    public function setNettopreis(int $nettopreis): self
    {
        $this->nettopreis = $nettopreis;

        return $this;
    }

    public function getKunde(): ?Kunden
    {
        return $this->kunde;
    }

    public function setKunde(?Kunden $kunde): self
    {
        $this->kunde = $kunde;

        return $this;
    }

    /**
     * @return Collection<int, Produkt>
     */
    public function getProdukts(): Collection
    {
        return $this->produkts;
    }

    public function addProdukt(Produkt $produkt): self
    {
        if (!$this->produkts->contains($produkt)) {
            $this->produkts->add($produkt);
            $produkt->addRechnung($this);
        }

        return $this;
    }

    public function removeProdukt(Produkt $produkt): self
    {
        if ($this->produkts->removeElement($produkt)) {
            $produkt->removeRechnung($this);
        }

        return $this;
    }

    public function getRechnungsposition(): ?Rechnungspositionen
    {
        return $this->rechnungsposition;
    }

    public function setRechnungsposition(?Rechnungspositionen $rechnungsposition): self
    {
        $this->rechnungsposition = $rechnungsposition;

        return $this;
    }

    public function addRechnungsposition(Rechnungspositionen $rechnungsposition): self
    {
        if (!$this->Rechnungsposition->contains($rechnungsposition)) {
            $this->Rechnungsposition->add($rechnungsposition);
            $rechnungsposition->setRechnung($this);
        }

        return $this;
    }

    public function removeRechnungsposition(Rechnungspositionen $rechnungsposition): self
    {
        if ($this->Rechnungsposition->removeElement($rechnungsposition)) {
            // set the owning side to null (unless already changed)
            if ($rechnungsposition->getRechnung() === $this) {
                $rechnungsposition->setRechnung(null);
            }
        }

        return $this;
    }
}
