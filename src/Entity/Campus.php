<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampusRepository::class)
 */
class Campus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Sortie::class, mappedBy="campus")
     */
    private $sorties;

    /**
     * @ORM\OneToMany(targetEntity=Participant::class, mappedBy="campus")
     */
    private $estRattacheA;

    public function __construct()
    {
        $this->sorties = new ArrayCollection();
        $this->estRattacheA = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Sortie[]
     */
    public function getSorties(): Collection
    {
        return $this->sorties;
    }

    public function addSorty(Sortie $sorty): self
    {
        if (!$this->sorties->contains($sorty)) {
            $this->sorties[] = $sorty;
            $sorty->setCampus($this);
        }

        return $this;
    }

    public function removeSorty(Sortie $sorty): self
    {
        if ($this->sorties->removeElement($sorty)) {
            // set the owning side to null (unless already changed)
            if ($sorty->getCampus() === $this) {
                $sorty->setCampus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Participant[]
     */
    public function getEstRattacheA(): Collection
    {
        return $this->estRattacheA;
    }

    public function addEstRattacheA(Participant $estRattacheA): self
    {
        if (!$this->estRattacheA->contains($estRattacheA)) {
            $this->estRattacheA[] = $estRattacheA;
            $estRattacheA->setCampus($this);
        }

        return $this;
    }

    public function removeEstRattacheA(Participant $estRattacheA): self
    {
        if ($this->estRattacheA->removeElement($estRattacheA)) {
            // set the owning side to null (unless already changed)
            if ($estRattacheA->getCampus() === $this) {
                $estRattacheA->setCampus(null);
            }
        }

        return $this;
    }
}
