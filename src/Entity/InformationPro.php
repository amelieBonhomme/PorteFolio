<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "information_pro")]
class InformationPro
{
    #[ORM\Id]
    #[ORM\Column(name: "id_pro", type: "string", length: 50)]
    private ?string $id = null;

    #[ORM\Column(name: "nom_entreprise", type: "string", length: 50)]
    private string $nomEntreprise;

    #[ORM\Column(name: "titre_poste", type: "string", length: 50)]
    private string $titrePoste;

    #[ORM\Column(name: "description_entreprise", type: "string", length: 255)]
    private string $descriptionEntreprise;

    #[ORM\Column(name: "lien_site", type: "string", length: 255)]
    private string $lienSite;

    #[ORM\Column(name: "ordre_pro", type: "string", length: 50, nullable: true)]
    private ?string $ordrePro = null;

    // 🔗 Relation vers PAdmin
    #[ORM\ManyToOne(targetEntity: PAdmin::class)]
    #[ORM\JoinColumn(name: "id_admin", referencedColumnName: "id_admin")]
    private ?PAdmin $admin = null;

    // ---------------------------------------------------------
    // 🔗 OneToMany vers Image (une expérience pro → plusieurs images)
    // ---------------------------------------------------------
    #[ORM\OneToMany(
        mappedBy: "informationPro",
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

    public function getNomEntreprise(): ?string
    {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(string $nomEntreprise): self
    {
        $this->nomEntreprise = $nomEntreprise;
        return $this;
    }

    public function getTitrePoste(): ?string
    {
        return $this->titrePoste;
    }

    public function setTitrePoste(string $titrePoste): self
    {
        $this->titrePoste = $titrePoste;
        return $this;
    }

    public function getDescriptionEntreprise(): ?string
    {
        return $this->descriptionEntreprise;
    }

    public function setDescriptionEntreprise(string $descriptionEntreprise): self
    {
        $this->descriptionEntreprise = $descriptionEntreprise;
        return $this;
    }

    public function getLienSite(): ?string
    {
        return $this->lienSite;
    }

    public function setLienSite(string $lienSite): self
    {
        $this->lienSite = $lienSite;
        return $this;
    }

    public function getOrdrePro(): ?string
    {
        return $this->ordrePro;
    }

    public function setOrdrePro(?string $ordrePro): self
    {
        $this->ordrePro = $ordrePro;
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
            $image->setInformationPro($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            if ($image->getInformationPro() === $this) {
                $image->setInformationPro(null);
            }
        }

        return $this;
    }
}
