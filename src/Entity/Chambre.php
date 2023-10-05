<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
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
    private $libelle_chambre;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $matricule_chambre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status_chambre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat_chambre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $delete_chambre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_modifier;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix_chambre;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="chambres")
     */
    private $chambre_categorie;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="chambres")
     */
    private $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="chambre")
     */
    private $reservations;

    /**
     * @ORM\Column(type="text")
     */
    private $description_chambre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image_chambre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image4;

    public function __construct()
    {
        $this->status_chambre = true;
        $this->etat_chambre = false;
        $this->delete_chambre = false;
        $this->date_creation = new \DateTime();
        $this->date_modifier = new \DateTime();
        $this->categorie = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleChambre(): ?string
    {
        return $this->libelle_chambre;
    }

    public function setLibelleChambre(string $libelle_chambre): self
    {
        $this->libelle_chambre = $libelle_chambre;

        return $this;
    }

    public function getMatriculeChambre(): ?string
    {
        return $this->matricule_chambre;
    }

    public function setMatriculeChambre(string $matricule_chambre): self
    {
        $this->matricule_chambre = $matricule_chambre;

        return $this;
    }

    public function getStatusChambre(): ?bool
    {
        return $this->status_chambre;
    }

    public function setStatusChambre(bool $status_chambre): self
    {
        $this->status_chambre = $status_chambre;

        return $this;
    }

    public function getEtatChambre(): ?bool
    {
        return $this->etat_chambre;
    }

    public function setEtatChambre(bool $etat_chambre): self
    {
        $this->etat_chambre = $etat_chambre;

        return $this;
    }

    public function getDeleteChambre(): ?bool
    {
        return $this->delete_chambre;
    }

    public function setDeleteChambre(bool $delete_chambre): self
    {
        $this->delete_chambre = $delete_chambre;

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

    public function getPrixChambre(): ?int
    {
        return $this->prix_chambre;
    }

    public function setPrixChambre(int $prix_chambre): self
    {
        $this->prix_chambre = $prix_chambre;

        return $this;
    }

    public function getChambreCategorie(): ?Categorie
    {
        return $this->chambre_categorie;
    }

    public function setChambreCategorie(?Categorie $chambre_categorie): self
    {
        $this->chambre_categorie = $chambre_categorie;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

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
            $reservation->setChambre($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getChambre() === $this) {
                $reservation->setChambre(null);
            }
        }

        return $this;
    }

    public function getDescriptionChambre(): ?string
    {
        return $this->description_chambre;
    }

    public function setDescriptionChambre(string $description_chambre): self
    {
        $this->description_chambre = $description_chambre;

        return $this;
    }

    public function getImageChambre(): ?string
    {
        return $this->image_chambre;
    }

    public function setImageChambre(string $image_chambre): self
    {
        $this->image_chambre = $image_chambre;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function setImage1(?string $image1): self
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(?string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image3;
    }

    public function setImage3(?string $image3): self
    {
        $this->image3 = $image3;

        return $this;
    }

    public function getImage4(): ?string
    {
        return $this->image4;
    }

    public function setImage4(?string $image4): self
    {
        $this->image4 = $image4;

        return $this;
    }
}
