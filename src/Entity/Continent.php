<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContinentRepository")
 */
class Continent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Decouverte", mappedBy="continent")
     */
    private $decouverte;

    public function __construct()
    {
        $this->decouverte = new ArrayCollection();
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

    /**
     * @return Collection|Decouverte[]
     */
    public function getDecouverte(): Collection
    {
        return $this->decouverte;
    }

    public function addDecouverte(Decouverte $decouverte): self
    {
        if (!$this->decouverte->contains($decouverte)) {
            $this->decouverte[] = $decouverte;
            $decouverte->setContinent($this);
        }

        return $this;
    }

    public function removeDecouverte(Decouverte $decouverte): self
    {
        if ($this->decouverte->contains($decouverte)) {
            $this->decouverte->removeElement($decouverte);
            // set the owning side to null (unless already changed)
            if ($decouverte->getContinent() === $this) {
                $decouverte->setContinent(null);
            }
        }

        return $this;
    }
}
