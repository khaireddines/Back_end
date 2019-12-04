<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRentRepository")
 *  
 */
class CarRent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Owner", inversedBy="carRents")
     * @ORM\JoinColumn(nullable=false)
     * @MaxDepth(1)
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $mark;

    /**
     * @ORM\Column(type="integer")
     * 
     */
    private $kilometer;

    /**
     * @ORM\Column(type="boolean")
     * 
     */
    private $availability;

    /**
     * @ORM\Column(type="float")
     * 
     */
    private $prix_day;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getKilometer(): ?int
    {
        return $this->kilometer;
    }

    public function setKilometer(int $kilometer): self
    {
        $this->kilometer = $kilometer;

        return $this;
    }

    public function getAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getPrixDay(): ?float
    {
        return $this->prix_day;
    }

    public function setPrixDay(float $prix_day): self
    {
        $this->prix_day = $prix_day;

        return $this;
    }
}
