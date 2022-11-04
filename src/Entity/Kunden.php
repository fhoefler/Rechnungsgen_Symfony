<?php

namespace App\Entity;

use App\Repository\KundenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: KundenRepository::class)]
class Kunden
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $kundennummer = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fntz = null;

    #[ORM\Column(length: 255)]
    private ?string $addresse = null;

    #[ORM\Column(length: 255)]
    private ?string $stadt = null;

    #[ORM\Column]
    private ?int $plz = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $uid = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fn = null;

    #[ORM\OneToMany(mappedBy: 'kunde', targetEntity: Rechnung::class)]
    private Collection $rechnung;

    public function __construct()
    {
        $this->rechnung = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKundennummer(): ?string
    {
        return $this->kundennummer;
    }

    public function setKundennummer(string $kundennummer): self
    {
        $this->kundennummer = $kundennummer;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getFntz(): ?string
    {
        return $this->fntz;
    }

    public function setFntz(?string $fntz): self
    {
        $this->fntz = $fntz;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(string $addresse): self
    {
        $this->addresse = $addresse;

        return $this;
    }

    public function getStadt(): ?string
    {
        return $this->stadt;
    }

    public function setStadt(string $stadt): self
    {
        $this->stadt = $stadt;

        return $this;
    }

    public function getPlz(): ?int
    {
        return $this->plz;
    }

    public function setPlz(int $plz): self
    {
        $this->plz = $plz;

        return $this;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(?string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getFn(): ?string
    {
        return $this->fn;
    }

    public function setFn(?string $fn): self
    {
        $this->fn = $fn;

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
            $rechnung->setKunde($this);
        }

        return $this;
    }

    public function removeRechnung(Rechnung $rechnung): self
    {
        if ($this->rechnung->removeElement($rechnung)) {
            // set the owning side to null (unless already changed)
            if ($rechnung->getKunde() === $this) {
                $rechnung->setKunde(null);
            }
        }

        return $this;
    }
}
