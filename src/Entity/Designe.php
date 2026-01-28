<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "designe")]
class Designe
{
    #[ORM\Id]
    #[ORM\Column(name: "id_designe", type: "string", length: 50)]
    private ?string $id = null;

    #[ORM\Column(name: "image_principale", type: "string", length: 255)]
    private string $imagePrincipale;

    #[ORM\Column(name: "couleur_fond", type: "string", length: 255)]
    private string $couleurFond;

    #[ORM\Column(name: "couleur_motivation_footer", type: "string", length: 255)]
    private string $couleurMotivationFooter;

    #[ORM\Column(name: "couleur_navigation", type: "string", length: 255, nullable: true)]
    private ?string $couleurNavigation = null;

    #[ORM\Column(name: "couleur_texte_general", type: "string", length: 255)]
    private string $couleurTexteGeneral;

    #[ORM\Column(name: "couleur_texte_motivation_footer", type: "string", length: 255)]
    private string $couleurTexteMotivationFooter;

    #[ORM\Column(name: "couleur_texte_navigation", type: "string", length: 255)]
    private string $couleurTexteNavigation;

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

    public function getImagePrincipale(): ?string
    {
        return $this->imagePrincipale;
    }

    public function setImagePrincipale(string $imagePrincipale): self
    {
        $this->imagePrincipale = $imagePrincipale;
        return $this;
    }

    public function getCouleurFond(): ?string
    {
        return $this->couleurFond;
    }

    public function setCouleurFond(string $couleurFond): self
    {
        $this->couleurFond = $couleurFond;
        return $this;
    }

    public function getCouleurMotivationFooter(): ?string
    {
        return $this->couleurMotivationFooter;
    }

    public function setCouleurMotivationFooter(string $couleurMotivationFooter): self
    {
        $this->couleurMotivationFooter = $couleurMotivationFooter;
        return $this;
    }

    public function getCouleurNavigation(): ?string
    {
        return $this->couleurNavigation;
    }

    public function setCouleurNavigation(?string $couleurNavigation): self
    {
        $this->couleurNavigation = $couleurNavigation;
        return $this;
    }

    public function getCouleurTexteGeneral(): ?string
    {
        return $this->couleurTexteGeneral;
    }

    public function setCouleurTexteGeneral(string $couleurTexteGeneral): self
    {
        $this->couleurTexteGeneral = $couleurTexteGeneral;
        return $this;
    }

    public function getCouleurTexteMotivationFooter(): ?string
    {
        return $this->couleurTexteMotivationFooter;
    }

    public function setCouleurTexteMotivationFooter(string $couleurTexteMotivationFooter): self
    {
        $this->couleurTexteMotivationFooter = $couleurTexteMotivationFooter;
        return $this;
    }

    public function getCouleurTexteNavigation(): ?string
    {
        return $this->couleurTexteNavigation;
    }

    public function setCouleurTexteNavigation(string $couleurTexteNavigation): self
    {
        $this->couleurTexteNavigation = $couleurTexteNavigation;
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
