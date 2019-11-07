<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DegreeRepository")
 */
class Degree
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    private $year;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Promotion", mappedBy="Degree")
     */
    private $promotions;

    public function __construct()
    {
        $this->year = new ArrayCollection();
        $this->promotions = new ArrayCollection();
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
     * @return Collection|Promotion[]
     */
    public function getYear(): Collection
    {
        return $this->year;
    }

    public function addYear(Promotion $year): self
    {
        if (!$this->year->contains($year)) {
            $this->year[] = $year;
            $year->setDegree($this);
        }

        return $this;
    }

    public function removeYear(Promotion $year): self
    {
        if ($this->year->contains($year)) {
            $this->year->removeElement($year);
            // set the owning side to null (unless already changed)
            if ($year->getDegree() === $this) {
                $year->setDegree(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Promotion[]
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotion $promotion): self
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions[] = $promotion;
            $promotion->setDegree($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotions->contains($promotion)) {
            $this->promotions->removeElement($promotion);
            // set the owning side to null (unless already changed)
            if ($promotion->getDegree() === $this) {
                $promotion->setDegree(null);
            }
        }

        return $this;
    }
}
