<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Presente
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: PAdmin::class)]
    #[ORM\JoinColumn(name: 'IDAdmin', referencedColumnName: 'IDAdmin')]
    private PAdmin $admin;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Projet::class)]
    #[ORM\JoinColumn(name: 'IDprojet', referencedColumnName: 'IDprojet')]
    private Projet $projet;

    public function getAdmin(): ?PAdmin
    {
        return $this->admin;
    }

    public function setAdmin(?PAdmin $admin): static
    {
        $this->admin = $admin;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): static
    {
        $this->projet = $projet;

        return $this;
    }
}
