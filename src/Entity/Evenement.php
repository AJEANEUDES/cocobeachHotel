<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
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
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status_event;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date_event;

    /**
     * @ORM\Column(type="boolean")
     */
    private $delete_event;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_modifier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titre_event;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_event;

    public function __construct()
    {
        $this->status_event = true;
        $this->delete_event = false;
        $this->date_creation = new \DateTime();
        $this->date_modifier = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getStatusEvent(): ?bool
    {
        return $this->status_event;
    }

    public function setStatusEvent(bool $status_event): self
    {
        $this->status_event = $status_event;

        return $this;
    }

    public function getDateEvent(): ?string
    {
        return $this->date_event;
    }

    public function setDateEvent(string $date_event): self
    {
        $this->date_event = $date_event;

        return $this;
    }

    public function getDeleteEvent(): ?bool
    {
        return $this->delete_event;
    }

    public function setDeleteEvent(bool $delete_event): self
    {
        $this->delete_event = $delete_event;

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

    public function getTitreEvent(): ?string
    {
        return $this->titre_event;
    }

    public function setTitreEvent(string $titre_event): self
    {
        $this->titre_event = $titre_event;

        return $this;
    }

    public function getDescriptionEvent(): ?string
    {
        return $this->description_event;
    }

    public function setDescriptionEvent(string $description_event): self
    {
        $this->description_event = $description_event;

        return $this;
    }
}
