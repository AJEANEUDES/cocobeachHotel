<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MenuRepository::class)
 */
class Menu
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
    private $nom_menu;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status_menu;

    /**
     * @ORM\Column(type="boolean")
     */
    private $delete_menu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\OneToMany(targetEntity=Restaurant::class, mappedBy="menus")
     */
    private $restaurants;

    public function __construct()
    {
        $this->status_menu = true;
        $this->delete_menu = false;
        $this->date_creation = new \DateTime();
        $this->restaurants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMenu(): ?string
    {
        return $this->nom_menu;
    }

    public function setNomMenu(string $nom_menu): self
    {
        $this->nom_menu = $nom_menu;

        return $this;
    }

    public function getStatusMenu(): ?bool
    {
        return $this->status_menu;
    }

    public function setStatusMenu(bool $status_menu): self
    {
        $this->status_menu = $status_menu;

        return $this;
    }

    public function getDeleteMenu(): ?bool
    {
        return $this->delete_menu;
    }

    public function setDeleteMenu(bool $delete_menu): self
    {
        $this->delete_menu = $delete_menu;

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

    /**
     * @return Collection|Restaurant[]
     */
    public function getRestaurants(): Collection
    {
        return $this->restaurants;
    }

    public function addRestaurant(Restaurant $restaurant): self
    {
        if (!$this->restaurants->contains($restaurant)) {
            $this->restaurants[] = $restaurant;
            $restaurant->setMenus($this);
        }

        return $this;
    }

    public function removeRestaurant(Restaurant $restaurant): self
    {
        if ($this->restaurants->removeElement($restaurant)) {
            // set the owning side to null (unless already changed)
            if ($restaurant->getMenus() === $this) {
                $restaurant->setMenus(null);
            }
        }

        return $this;
    }
}
