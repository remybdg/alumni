<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PromotionRepository")
 * @UniqueEntity(fields={"degree", "year"})
 */
class Promotion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Degree", inversedBy="promotions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $degree;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Year", inversedBy="promotions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $year;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="promotions")
     */
    private $users;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $notes;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDegree(): ?Degree
    {
        return $this->degree;
    }

    public function setDegree(?Degree $Degree): self
    {
        $this->degree = $Degree;

        return $this;
    }

    public function getYear(): ?Year
    {
        return $this->year;
    }

    public function setYear(?Year $Year): self
    {
        $this->year = $Year;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addPromotion($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removePromotion($this);
        }

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($notes): self
    {
        $this->notes = $notes;

        return $this;
    }
}
