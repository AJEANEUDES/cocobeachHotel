<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $libelle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $delete_categorie;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_modifier;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="categories")
     */
    private $utilisateur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status_categorie;

    /**
     * @ORM\OneToMany(targetEntity=Chambre::class, mappedBy="chambre_categorie")
     */
    private $chambres;

    public function __construct()
    {
        $this->status_categorie = true;
        $this->delete_categorie = false;
        $this->date_creation = new \DateTime();
        $this->date_modifier = new \DateTime();
        $this->chambres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDeleteCategorie(): ?bool
    {
        return $this->delete_categorie;
    }

    public function setDeleteCategorie(bool $delete_categorie): self
    {
        $this->delete_categorie = $delete_categorie;

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

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getStatusCategorie(): ?bool
    {
        return $this->status_categorie;
    }

    public function setStatusCategorie(bool $status_categorie): self
    {
        $this->status_categorie = $status_categorie;

        return $this;
    }

    /**
     * @return Collection|Chambre[]
     */
    public function getChambres(): Collection
    {
        return $this->chambres;
    }

    public function addChambre(Chambre $chambre): self
    {
        if (!$this->chambres->contains($chambre)) {
            $this->chambres[] = $chambre;
            $chambre->setChambreCategorie($this);
        }

        return $this;
    }

    public function removeChambre(Chambre $chambre): self
    {
        if ($this->chambres->removeElement($chambre)) {
            // set the owning side to null (unless already changed)
            if ($chambre->getChambreCategorie() === $this) {
                $chambre->setChambreCategorie(null);
            }
        }

        return $this;
    }
}
