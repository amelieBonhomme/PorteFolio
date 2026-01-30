<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "information_personelle")]
class InformationPersonelle
{
    #[ORM\Id]
    #[ORM\Column(name: "id_Info_perso", type: "string", length: 50)]
    private ?string $id = null;

    #[ORM\Column(name: "nom", type: "string", length: 50)]
    private string $nom;

    #[ORM\Column(name: "prenom", type: "string", length: 50)]
    private string $prenom;

    #[ORM\Column(name: "photo", type: "blob", nullable: true)]
    private $photo;

    #[ORM\Column(name: "metier", type: "string", length: 50)]
    private string $metier;

    #[ORM\Column(name: "description", type: "string", length: 255)]
    private string $description;

    #[ORM\Column(name: "mail", type: "string", length: 50)]
    private string $mail;

    #[ORM\Column(name: "telephone", type: "string", length: 50)]
    private string $telephone;

    #[ORM\Column(name: "localisation_map", type: "string", length: 50)]
    private string $localisationMap;

    #[ORM\Column(name: "linkedin", type: "string", length: 50)]
    private string $linkedin;

    #[ORM\Column(name: "centre_interet_img", type: "string", length: 255)]
    private string $centreInteretImg;

    #[ORM\Column(name: "centre_interet_texte", type: "string", length: 50)]
    private string $centreInteretTexte;

    #[ORM\Column(name: "ordre_perso", type: "string", length: 50, nullable: true)]
    private ?string $ordrePerso = null;

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;
        return $this;
    }

    public function getMetier(): ?string
    {
        return $this->metier;
    }

    public function setMetier(string $metier): self
    {
        $this->metier = $metier;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;
        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }

    public function getLocalisationMap(): ?string
    {
        return $this->localisationMap;
    }

    public function setLocalisationMap(string $localisationMap): self
    {
        $this->localisationMap = $localisationMap;
        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(string $linkedin): self
    {
        $this->linkedin = $linkedin;
        return $this;
    }

    public function getCentreInteretImg(): ?string
    {
        return $this->centreInteretImg;
    }

    public function setCentreInteretImg(string $img): self
    {
        $this->centreInteretImg = $img;
        return $this;
    }

    public function getCentreInteretTexte(): ?string
    {
        return $this->centreInteretTexte;
    }

    public function setCentreInteretTexte(string $texte): self
    {
        $this->centreInteretTexte = $texte;
        return $this;
    }

    public function getOrdrePerso(): ?string
    {
        return $this->ordrePerso;
    }

    public function setOrdrePerso(?string $ordre): self
    {
        $this->ordrePerso = $ordre;
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
