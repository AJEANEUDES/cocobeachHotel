<?php

namespace App\DataTransferObject;

class Credentials
{
    private $email_utilisateur = null;

    private $password = null;

    private $status_utilisateur = true;

    public function __construct($email = null)
    {
        $this->email_utilisateur = $email;
    }

    public function getEmailUtilisateur(): ?string
    {
        return $this->email_utilisateur;
    }

    public function setEmailUtilisateur(string $email_utilisateur): self
    {
        $this->email_utilisateur = $email_utilisateur;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getStatusUtilisateur(): ?bool
    {
        return $this->status_utilisateur;
    }

    public function setStatusUtilisateur(bool $status): self
    {
        $this->status_utilisateur = $status;

        return $this;
    }
}
