<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom_client;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $prenom_client;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $telephone_client;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email_client;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status_client;

    /**
     * @ORM\Column(type="boolean")
     */
    private $delete_client;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_modifier;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="client")
     */
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity=Service::class, mappedBy="client")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity=Online::class, mappedBy="client")
     */
    private $onlines;

    public function __construct()
    {
        $this->status_client = true;
        $this->delete_client = false;
        $this->date_creation = new \DateTime();
        $this->date_modifier = new \DateTime();
        $this->reservations = new ArrayCollection();
        $this->services = new ArrayCollection();
        $this->onlines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClient(): ?string
    {
        return $this->nom_client;
    }

    public function setNomClient(string $nom_client): self
    {
        $this->nom_client = $nom_client;

        return $this;
    }

    public function getPrenomClient(): ?string
    {
        return $this->prenom_client;
    }

    public function setPrenomClient(string $prenom_client): self
    {
        $this->prenom_client = $prenom_client;

        return $this;
    }

    public function getTelephoneClient(): ?string
    {
        return $this->telephone_client;
    }

    public function setTelephoneClient(string $telephone_client): self
    {
        $this->telephone_client = $telephone_client;

        return $this;
    }

    public function getEmailClient(): ?string
    {
        return $this->email_client;
    }

    public function setEmailClient(?string $email_client): self
    {
        $this->email_client = $email_client;

        return $this;
    }

    public function getStatusClient(): ?bool
    {
        return $this->status_client;
    }

    public function setStatusClient(bool $status_client): self
    {
        $this->status_client = $status_client;

        return $this;
    }

    public function getDeleteClient(): ?bool
    {
        return $this->delete_client;
    }

    public function setDeleteClient(bool $delete_client): self
    {
        $this->delete_client = $delete_client;

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

    public function getDateModifier(): ?\DateTimeInterface
    {
        return $this->date_modifier;
    }

    public function setDateModifier(\DateTimeInterface $date_modifier): self
    {
        $this->date_modifier = $date_modifier;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setClient($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getClient() === $this) {
                $reservation->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->setClient($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getClient() === $this) {
                $service->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Online[]
     */
    public function getOnlines(): Collection
    {
        return $this->onlines;
    }

    public function addOnline(Online $online): self
    {
        if (!$this->onlines->contains($online)) {
            $this->onlines[] = $online;
            $online->setClient($this);
        }

        return $this;
    }

    public function removeOnline(Online $online): self
    {
        if ($this->onlines->removeElement($online)) {
            // set the owning side to null (unless already changed)
            if ($online->getClient() === $this) {
                $online->setClient(null);
            }
        }

        return $this;
    }
}
