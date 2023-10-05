<?php

namespace App\Entity;

use App\Repository\OnlineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OnlineRepository::class)
 */
class Online
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
    private $date_arrivee;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $date_depart;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $duree_reservation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $delete_reservation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat_reservation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status_reservation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $new_date_ajuster;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $new_date_depart;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $new_duree;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $duree_total;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_modifier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombre_chambre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombre_adulte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombre_enfant;

    public function __construct()
    {
        $this->delete_reservation = false;
        $this->date_creation = new \DateTime();
        $this->date_modifier = new \DateTime();
        $this->status_reservation = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateArrivee(): ?string
    {
        return $this->date_arrivee;
    }

    public function setDateArrivee(string $date_arrivee): self
    {
        $this->date_arrivee = $date_arrivee;

        return $this;
    }

    public function getDateDepart(): ?string
    {
        return $this->date_depart;
    }

    public function setDateDepart(string $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getDureeReservation(): ?string
    {
        return $this->duree_reservation;
    }

    public function setDureeReservation(?string $duree_reservation): self
    {
        $this->duree_reservation = $duree_reservation;

        return $this;
    }

    public function getDeleteReservation(): ?bool
    {
        return $this->delete_reservation;
    }

    public function setDeleteReservation(bool $delete_reservation): self
    {
        $this->delete_reservation = $delete_reservation;

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

    public function getEtatReservation(): ?string
    {
        return $this->etat_reservation;
    }

    public function setEtatReservation(string $etat_reservation): self
    {
        $this->etat_reservation = $etat_reservation;

        return $this;
    }

    public function getStatusReservation(): ?bool
    {
        return $this->status_reservation;
    }

    public function setStatusReservation(bool $status_reservation): self
    {
        $this->status_reservation = $status_reservation;

        return $this;
    }

    public function getNewDateAjuster(): ?string
    {
        return $this->new_date_ajuster;
    }

    public function setNewDateAjuster(?string $new_date_ajuster): self
    {
        $this->new_date_ajuster = $new_date_ajuster;

        return $this;
    }

    public function getNewDateDepart(): ?string
    {
        return $this->new_date_depart;
    }

    public function setNewDateDepart(?string $new_date_depart): self
    {
        $this->new_date_depart = $new_date_depart;

        return $this;
    }

    public function getNewDuree(): ?string
    {
        return $this->new_duree;
    }

    public function setNewDuree(?string $new_duree): self
    {
        $this->new_duree = $new_duree;

        return $this;
    }

    public function getDureeTotal(): ?string
    {
        return $this->duree_total;
    }

    public function setDureeTotal(?string $duree_total): self
    {
        $this->duree_total = $duree_total;

        return $this;
    }

    public function getDateModifier(): ?\DateTimeInterface
    {
        return $this->date_modifier;
    }

    public function setDateModifier(?\DateTimeInterface $date_modifier): self
    {
        $this->date_modifier = $date_modifier;

        return $this;
    }

    public function getNombreChambre(): ?string
    {
        return $this->nombre_chambre;
    }

    public function setNombreChambre(?string $nombre_chambre): self
    {
        $this->nombre_chambre = $nombre_chambre;

        return $this;
    }

    public function getNombreAdulte(): ?string
    {
        return $this->nombre_adulte;
    }

    public function setNombreAdulte(?string $nombre_adulte): self
    {
        $this->nombre_adulte = $nombre_adulte;

        return $this;
    }

    public function getNombreEnfant(): ?string
    {
        return $this->nombre_enfant;
    }

    public function setNombreEnfant(?string $nombre_enfant): self
    {
        $this->nombre_enfant = $nombre_enfant;

        return $this;
    }
}
