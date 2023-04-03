<?php

namespace App\Entity;

use App\Repository\AppartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: AppartementRepository::class)]
class Appartement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $lien_image = null;

    #[ORM\Column]
    #[Assert\PositiveOrZero]
    private ?float $prix = null;

    #[ORM\OneToMany(mappedBy: 'appart_id', targetEntity: Lieu::class)]
    private Collection $lieu;

    #[ORM\OneToMany(mappedBy: 'appart_id', targetEntity: Critere::class)]
    private Collection $critere;

    public function __construct()
    {
        $this->lieu = new ArrayCollection();
        $this->critere = new ArrayCollection();
    }

     public function __toString(): string
    {
        return $this->Titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLienImage(): ?string
    {
        return $this->lien_image;
    }

    public function setLienImage(string $lien_image): self
    {
        $this->lien_image = $lien_image;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Lieu>
     */
    public function getLieu(): Collection
    {
        return $this->lieu;
    }

    public function addLieu(Lieu $lieu): self
    {
        if (!$this->lieu->contains($lieu)) {
            $this->lieu->add($lieu);
            $lieu->setAppartId($this);
        }

        return $this;
    }

    public function removeLieu(Lieu $lieu): self
    {
        if ($this->lieu->removeElement($lieu)) {
            // set the owning side to null (unless already changed)
            if ($lieu->getAppartId() === $this) {
                $lieu->setAppartId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Critere>
     */
    public function getCritere(): Collection
    {
        return $this->critere;
    }

    public function addCritere(Critere $critere): self
    {
        if (!$this->critere->contains($critere)) {
            $this->critere->add($critere);
            $critere->setAppartId($this);
        }

        return $this;
    }

    public function removeCritere(Critere $critere): self
    {
        if ($this->critere->removeElement($critere)) {
            // set the owning side to null (unless already changed)
            if ($critere->getAppartId() === $this) {
                $critere->setAppartId(null);
            }
        }

        return $this;
    }
}
