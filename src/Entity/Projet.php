<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "projet")]
class Projet
{
    #[ORM\Id]
    #[ORM\Column(name: "id_projet", type: "string", length: 50)]
    private ?string $id = null;

    #[ORM\Column(name: "titre_projet", type: "string", length: 50)]
    private string $titreProjet;

    #[ORM\Column(name: "pdf", type: "string", length: 50)]
    private string $pdf;

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

    public function getTitreProjet(): ?string
    {
        return $this->titreProjet;
    }

    public function setTitreProjet(string $titreProjet): self
    {
        $this->titreProjet = $titreProjet;
        return $this;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(string $pdf): self
    {
        $this->pdf = $pdf;
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
