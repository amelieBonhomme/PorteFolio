<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'InformationPersonelle')]
class InformationPersonelle
{
    #[ORM\Id]
    #[ORM\Column(name: 'IDInfoP', type: 'string', length: 50)]
    private string $IDInfoP;

    #[ORM\Column(name: 'nom', type: 'string', length: 50)]
    private string $nom;

    #[ORM\Column(name: 'prenom', type: 'string', length: 50)]
    private string $prenom; 

    #[ORM\Column(name: 'description', type: 'string', length: 50)]
    private string $description;

    #[ORM\Column(name: 'mail', type: 'string', length: 50)]
    private string $mail;

    #[ORM\Column(name: 'telephone', type: 'string', length: 50)]
    private string $telephone;

    #[ORM\Column(name: 'localisationMap', type: 'string', length: 50)]
    private string $localisationMap;

    #[ORM\Column(name: 'linkedin', type: 'string', length: 50)]
    private string $linkedin;

    #[ORM\Column(name: 'infoPersoActif', type: 'boolean')]
    private bool $infoPersoActif;

    #[ORM\Column(name: 'centreInteretImg', type: 'string', length: 50)]
    private string $centreInteretImg;

    #[ORM\Column(name: 'centreInteretTexte', type: 'string', length: 50)]
    private string $centreInteretTexte;

    #[ORM\Column(name: 'metier', type: 'string', length: 50, nullable: true)]
    private ?string $metier = null;

    public function getIDInfoP(): ?string
    {
        return $this->IDInfoP;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getLocalisationMap(): ?string
    {
        return $this->localisationMap;
    }

    public function setLocalisationMap(string $localisationMap): static
    {
        $this->localisationMap = $localisationMap;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(string $linkedin): static
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function isInfoPersoActif(): ?bool
    {
        return $this->infoPersoActif;
    }

    public function setInfoPersoActif(bool $infoPersoActif): static
    {
        $this->infoPersoActif = $infoPersoActif;

        return $this;
    }

    public function getCentreInteretImg(): ?string
    {
        return $this->centreInteretImg;
    }

    public function setCentreInteretImg(string $centreInteretImg): static
    {
        $this->centreInteretImg = $centreInteretImg;

        return $this;
    }

    public function getCentreInteretTexte(): ?string
    {
        return $this->centreInteretTexte;
    }

    public function setCentreInteretTexte(string $centreInteretTexte): static
    {
        $this->centreInteretTexte = $centreInteretTexte;

        return $this;
    }

    public function getMetier(): ?string
    {
        return $this->metier;
    }

    public function setMetier(?string $metier): static
    {
        $this->metier = $metier;
        return $this;
    }
}
