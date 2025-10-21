<?php

namespace App\Entity;

use App\Repository\InformationProRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InformationProRepository::class)]
class InformationPro
{
    #[ORM\Id]
    #[ORM\Column(name: 'ID_pro', type: 'string', length: 50)]
    private string $ID_pro;

    #[ORM\Column(type: 'string', length: 50)]
    private string $nomEntreprise;

    #[ORM\Column(type: 'string', length: 50)]
    private string $titrePoste;

    #[ORM\Column(type: 'string', length: 50)]
    private string $logo;

    #[ORM\Column(type: 'string', length: 50)]
    private string $descriptionEntreprise1;

    #[ORM\Column(type: 'string', length: 50)]
    private string $lienSite;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $dateDebut;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(type: 'boolean')]
    private bool $infoProActif;

    // Getters et setters (tu peux les générer automatiquement avec ton IDE)

    public function getIDPro(): ?string
    {
        return $this->ID_pro;
    }

    public function setIDPro(string $ID_pro): static
    {
        $this->ID_pro = $ID_pro;

        return $this;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(string $nomEntreprise): static
    {
        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }

    public function getTitrePoste(): ?string
    {
        return $this->titrePoste;
    }

    public function setTitrePoste(string $titrePoste): static
    {
        $this->titrePoste = $titrePoste;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getDescriptionEntreprise1(): ?string
    {
        return $this->descriptionEntreprise1;
    }

    public function setDescriptionEntreprise1(string $descriptionEntreprise1): static
    {
        $this->descriptionEntreprise1 = $descriptionEntreprise1;

        return $this;
    }

    public function getLienSite(): ?string
    {
        return $this->lienSite;
    }

    public function setLienSite(string $lienSite): static
    {
        $this->lienSite = $lienSite;

        return $this;
    }

    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTime $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTime $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function isInfoProActif(): ?bool
    {
        return $this->infoProActif;
    }

    public function setInfoProActif(bool $infoProActif): static
    {
        $this->infoProActif = $infoProActif;

        return $this;
    }
}
