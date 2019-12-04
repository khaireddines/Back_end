<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaxiRepository")
 * 
 */
class Taxi
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Owner", inversedBy="taxis")
     * @ORM\JoinColumn(nullable=false)
     * @MaxDepth(1)
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $registration_number;

    /**
     * @ORM\Column(type="integer")
     */
    private $taxi_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mark;

    /**
     * @ORM\Column(type="boolean")
     */
    private $onService;

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

    public function getRegistrationNumber(): ?string
    {
        return $this->registration_number;
    }

    public function setRegistrationNumber(string $registration_number): self
    {
        $this->registration_number = $registration_number;

        return $this;
    }

    public function getTaxiNumber(): ?int
    {
        return $this->taxi_number;
    }

    public function setTaxiNumber(int $taxi_number): self
    {
        $this->taxi_number = $taxi_number;

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

    public function getOnService(): ?bool
    {
        return $this->onService;
    }

    public function setOnService(bool $onService): self
    {
        $this->onService = $onService;

        return $this;
    }
}
