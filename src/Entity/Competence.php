<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "competence")]
class Competence
{
    #[ORM\Id]
    #[ORM\Column(name: "id_competence", type: "string", length: 50)]
    private ?string $id = null;

    #[ORM\ManyToOne(targetEntity: PAdmin::class)]
    #[ORM\JoinColumn(name: "id_admin", referencedColumnName: "id_admin")]
    private ?PAdmin $admin = null;

    // ---------------------------------------------------------
    // 🔗 OneToMany vers Image (une compétence → plusieurs images)
    // ---------------------------------------------------------
    #[ORM\OneToMany(
        mappedBy: "competence",
        targetEntity: Image::class,
        orphanRemoval: true
    )]
    private Collection $images;

    // ---------------------------------------------------------
    // CONSTRUCTEUR
    // ---------------------------------------------------------
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    // ---------------------------------------------------------
    // GETTERS / SETTERS
    // ---------------------------------------------------------

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
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

    // ---------------------------------------------------------
    // 🔗 GESTION DES IMAGES
    // ---------------------------------------------------------

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setCompetence($this); // très important !
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            if ($image->getCompetence() === $this) {
                $image->setCompetence(null);
            }
        }

        return $this;
    }
}