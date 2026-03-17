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

    #[ORM\Column(name: "grille_e5", type: "text", nullable: true)]
    private ?string $grille;

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
    // 🔗 OneToMany vers document (une compétence → plusieurs doc)
    // ---------------------------------------------------------

    #[ORM\OneToMany(
        mappedBy: "competence",
        targetEntity: Document::class,
        orphanRemoval: true
    )]
    private Collection $documents;

    // ---------------------------------------------------------
    // CONSTRUCTEUR
    // ---------------------------------------------------------
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->documents = new ArrayCollection();
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
    public function getGrille(): ?string
    {
        return $this->grille;
    }

    public function setGrille(?string $grille): self
    {
        $this->grille = $grille;
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
    // ---------------------------------------------------------
    // 🔗 GESTION DES DOCUMENTS
    // ---------------------------------------------------------
    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setCompetence($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->removeElement($document)) {
            if ($document->getCompetence() === $this) {
                $document->setCompetence(null);
            }
        }

        return $this;
    }
}