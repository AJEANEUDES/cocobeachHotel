<?php

namespace App\Entity;

use App\Repository\RestaurantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
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
    private $nom_plat;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status_plat;

    /**
     * @ORM\Column(type="boolean")
     */
    private $delete_plat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix_plat;

    /**
     * @ORM\ManyToOne(targetEntity=Menu::class, inversedBy="restaurants")
     */
    private $menus;

    public function __construct()
    {
        $this->status_plat = true;
        $this->delete_plat = false;
        $this->date_creation = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPlat(): ?string
    {
        return $this->nom_plat;
    }

    public function setNomPlat(string $nom_plat): self
    {
        $this->nom_plat = $nom_plat;

        return $this;
    }

    public function getStatusPlat(): ?bool
    {
        return $this->status_plat;
    }

    public function setStatusPlat(bool $status_plat): self
    {
        $this->status_plat = $status_plat;

        return $this;
    }

    public function getDeletePlat(): ?bool
    {
        return $this->delete_plat;
    }

    public function setDeletePlat(bool $delete_plat): self
    {
        $this->delete_plat = $delete_plat;

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

    public function getPrixPlat(): ?string
    {
        return $this->prix_plat;
    }

    public function setPrixPlat(string $prix_plat): self
    {
        $this->prix_plat = $prix_plat;

        return $this;
    }

    public function getMenus(): ?Menu
    {
        return $this->menus;
    }

    public function setMenus(?Menu $menus): self
    {
        $this->menus = $menus;

        return $this;
    }
}
