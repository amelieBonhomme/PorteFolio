<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity]
#[ORM\Table(name: "p_admin")]
class PAdmin implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(name: "id_admin", type: "string", length: 50)]
    private ?string $id = null;

    #[ORM\Column(name: "login", type: "string", length: 50, unique: true)]
    private string $login;

    // ⚡ longueur augmentée pour stocker un hash
    #[ORM\Column(name: "mdp", type: "string", length: 255)]
    private string $mdp;

    // -------------------------
    // GETTERS / SETTERS
    // -------------------------

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;
        return $this;
    }

    // -------------------------
    // SECURITY INTERFACE
    // -------------------------

    public function getPassword(): string
    {
        return $this->mdp;
    }

    public function setPassword(string $password): self
    {
        $this->mdp = $password;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->login;
    }

    public function getRoles(): array
    {
        return ['ROLE_ADMIN'];
    }

    public function eraseCredentials(): void
    {
        // rien à nettoyer
    }
}
