<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "competence")]
class Competence
{
    #[ORM\Id]
    #[ORM\Column(name: "id_competence", type: "string", length: 50)]
    private ?string $id = null;

    #[ORM\Column(name: "logo_ligne", type: "string", length: 255)]
    private string $logoLigne;

    // 🔗 Relation vers PAdmin
    #[ORM\ManyToOne(targetEntity: PAdmin::class)]
    #[ORM\JoinColumn(name: "id_admin", referencedColumnName: "id_admin")]
    private ?PAdmin $admin = null;

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

    public function getLogoLigne(): ?string
    {
        return $this->logoLigne;
    }

    public function setLogoLigne(string $logoLigne): self
    {
        $this->logoLigne = $logoLigne;
        return $this;
    }

    public function getAdmin(): ?PAdmin
    {
        return $this->admin;
    }

    public function setAdmin(?PAdmin $admin): self
    {
        $this->admin = $admin;
        return $this;
    }
}
