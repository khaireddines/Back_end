<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OwnerRepository")
 * 
 */
class Owner
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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Accommodation", mappedBy="owner")
     */
    private $accommodations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Taxi", mappedBy="owner")
     */
    private $taxis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CarRent", mappedBy="owner")
     */
    private $carRents;

    public function __construct()
    {
        $this->accommodations = new ArrayCollection();
        $this->taxis = new ArrayCollection();
        $this->carRents = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|Accommodation[]
     */
    public function getAccommodations(): Collection
    {
        return $this->accommodations;
    }

    public function addAccommodation(Accommodation $accommodation): self
    {
        if (!$this->accommodations->contains($accommodation)) {
            $this->accommodations[] = $accommodation;
            $accommodation->setOwner($this);
        }

        return $this;
    }

    public function removeAccommodation(Accommodation $accommodation): self
    {
        if ($this->accommodations->contains($accommodation)) {
            $this->accommodations->removeElement($accommodation);
            // set the owning side to null (unless already changed)
            if ($accommodation->getOwner() === $this) {
                $accommodation->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Taxi[]
     */
    public function getTaxis(): Collection
    {
        return $this->taxis;
    }

    public function addTaxi(Taxi $taxi): self
    {
        if (!$this->taxis->contains($taxi)) {
            $this->taxis[] = $taxi;
            $taxi->setOwner($this);
        }

        return $this;
    }

    public function removeTaxi(Taxi $taxi): self
    {
        if ($this->taxis->contains($taxi)) {
            $this->taxis->removeElement($taxi);
            // set the owning side to null (unless already changed)
            if ($taxi->getOwner() === $this) {
                $taxi->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CarRent[]
     */
    public function getCarRents(): Collection
    {
        return $this->carRents;
    }

    public function addCarRent(CarRent $carRent): self
    {
        if (!$this->carRents->contains($carRent)) {
            $this->carRents[] = $carRent;
            $carRent->setOwner($this);
        }

        return $this;
    }

    public function removeCarRent(CarRent $carRent): self
    {
        if ($this->carRents->contains($carRent)) {
            $this->carRents->removeElement($carRent);
            // set the owning side to null (unless already changed)
            if ($carRent->getOwner() === $this) {
                $carRent->setOwner(null);
            }
        }

        return $this;
    }
}
