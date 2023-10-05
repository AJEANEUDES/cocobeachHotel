<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
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
    private $libelle_service;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix_service;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date_service;

    /**
     * @ORM\ManyToOne(targetEntity=Reservation::class, inversedBy="services")
     */
    private $reservation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $delete_service;

    public function __construct()
    {
        $this->date_creation = new \DateTime();
        $this->delete_service = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleService(): ?string
    {
        return $this->libelle_service;
    }

    public function setLibelleService(string $libelle_service): self
    {
        $this->libelle_service = $libelle_service;

        return $this;
    }

    public function getPrixService(): ?int
    {
        return $this->prix_service;
    }

    public function setPrixService(int $prix_service): self
    {
        $this->prix_service = $prix_service;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateService(): ?string
    {
        return $this->date_service;
    }

    public function setDateService(string $date_service): self
    {
        $this->date_service = $date_service;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getDeleteService(): ?bool
    {
        return $this->delete_service;
    }

    public function setDeleteService(bool $delete_service): self
    {
        $this->delete_service = $delete_service;

        return $this;
    }
}
