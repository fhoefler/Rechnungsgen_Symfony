<?php

namespace App\Entity;

use App\Repository\RechnungRepository;
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
}
