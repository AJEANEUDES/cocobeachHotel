<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur implements UserInterface
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
    private $nom_utilisateur;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $prenom_utilisateur;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sexe_utilisateur;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $email_utilisateur;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $adresse_utilisateur;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $telephone_utilisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $level_utilisateur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status_utilisateur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $delete_utilisateur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_modifier;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="creer_par")
     */
    private $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity=Utilisateur::class, mappedBy="utilisateur")
     */
    private $creer_par;

    /**
     * @ORM\OneToMany(targetEntity=Categorie::class, mappedBy="utilisateur")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Chambre::class, mappedBy="utilisateur")
     */
    private $chambres;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="utilisateur")
     */
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity=Online::class, mappedBy="utilisateur")
     */
    private $onlines;

    public function __construct()
    {
        $this->creer_par = new ArrayCollection();
        $this->status_utilisateur = true;
        $this->delete_utilisateur = false;
        $this->date_creation = new \DateTime();
        $this->date_modifier = new \DateTime();
        $this->categories = new ArrayCollection();
        $this->chambres = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->onlines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nom_utilisateur;
    }

    public function setNomUtilisateur(string $nom_utilisateur): self
    {
        $this->nom_utilisateur = $nom_utilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenom_utilisateur;
    }

    public function setPrenomUtilisateur(string $prenom_utilisateur): self
    {
        $this->prenom_utilisateur = $prenom_utilisateur;

        return $this;
    }

    public function getSexeUtilisateur(): ?string
    {
        return $this->sexe_utilisateur;
    }

    public function setSexeUtilisateur(string $sexe_utilisateur): self
    {
        $this->sexe_utilisateur = $sexe_utilisateur;

        return $this;
    }

    public function getEmailUtilisateur(): ?string
    {
        return $this->email_utilisateur;
    }

    public function setEmailUtilisateur(?string $email_utilisateur): self
    {
        $this->email_utilisateur = $email_utilisateur;

        return $this;
    }

    public function getAdresseUtilisateur(): ?string
    {
        return $this->adresse_utilisateur;
    }

    public function setAdresseUtilisateur(string $adresse_utilisateur): self
    {
        $this->adresse_utilisateur = $adresse_utilisateur;

        return $this;
    }

    public function getTelephoneUtilisateur(): ?string
    {
        return $this->telephone_utilisateur;
    }

    public function setTelephoneUtilisateur(string $telephone_utilisateur): self
    {
        $this->telephone_utilisateur = $telephone_utilisateur;

        return $this;
    }

    public function getPasswords(): ?string
    {
        return $this->password;
    }

    public function setPasswords(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getLevelUtilisateur(): ?string
    {
        return $this->level_utilisateur;
    }

    public function setLevelUtilisateur(string $level_utilisateur): self
    {
        $this->level_utilisateur = $level_utilisateur;

        return $this;
    }

    public function getStatusUtilisateur(): ?bool
    {
        return $this->status_utilisateur;
    }

    public function setStatusUtilisateur(bool $status_utilisateur): self
    {
        $this->status_utilisateur = $status_utilisateur;

        return $this;
    }

    public function getDeleteUtilisateur(): ?bool
    {
        return $this->delete_utilisateur;
    }

    public function setDeleteUtilisateur(bool $delete_utilisateur): self
    {
        $this->delete_utilisateur = $delete_utilisateur;

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

    public function getUtilisateur(): ?self
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?self $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    //Importion des fonctions de l'interface UserInterface
    public function getRoles()
    {
        $level = $this->getLevelUtilisateur();
        if ($level == "A01")
            return ['ROLE_ADMIN'];
        else if ($level == "R02")
            return ['ROLE_ROOT'];
        else if ($level == "G03")
            return ['ROLE_GERANT'];
        else if ($level == "C04")
            return ['ROLE_CLIENT'];
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
    }

    public function getUsername()
    {
        return $this->email_utilisateur;
    }

    public function eraseCredentials()
    {
    }

    public function checkStatus()
    {
        return $this->status_utilisateur;
    }

    public function getCheckDeleteUtilisateurs(): ?bool
    {
        return $this->delete_utilisateur;
    }

    /**
     * @return Collection|self[]
     */
    public function getCreerPar(): Collection
    {
        return $this->creer_par;
    }

    public function addCreerPar(self $creerPar): self
    {
        if (!$this->creer_par->contains($creerPar)) {
            $this->creer_par[] = $creerPar;
            $creerPar->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCreerPar(self $creerPar): self
    {
        if ($this->creer_par->removeElement($creerPar)) {
            // set the owning side to null (unless already changed)
            if ($creerPar->getUtilisateur() === $this) {
                $creerPar->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getUtilisateur() === $this) {
                $category->setUtilisateur(null);
            }
        }

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
            $chambre->setUtilisateur($this);
        }

        return $this;
    }

    public function removeChambre(Chambre $chambre): self
    {
        if ($this->chambres->removeElement($chambre)) {
            // set the owning side to null (unless already changed)
            if ($chambre->getUtilisateur() === $this) {
                $chambre->setUtilisateur(null);
            }
        }

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
            $reservation->setUtilisateur($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUtilisateur() === $this) {
                $reservation->setUtilisateur(null);
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
            $online->setUtilisateur($this);
        }

        return $this;
    }

    public function removeOnline(Online $online): self
    {
        if ($this->onlines->removeElement($online)) {
            // set the owning side to null (unless already changed)
            if ($online->getUtilisateur() === $this) {
                $online->setUtilisateur(null);
            }
        }

        return $this;
    }
}
