<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "image")]
class Image
{
    #[ORM\Id]
    #[ORM\Column(length: 50)]
    private ?string $id_img = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $img = null;

    // Relation vers InformationPro
    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(name: 'id_pro', referencedColumnName: 'id_pro', nullable: true)]
    private ?InformationPro $informationPro = null;

    // Relation vers Competence
    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(name: 'id_competence', referencedColumnName: 'id_competence', nullable: true)]
    private ?Competence $competence = null;

    // Relation vers InformationPersonelle
    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(name: 'id_info_perso', referencedColumnName: 'id_info_perso', nullable: true)]
    private ?InformationPersonelle $informationPersonelle = null;

    public function getIdImg(): ?string
    {
        return $this->id_img;
    }

    public function setIdImg(string $id): self
    {
        $this->id_img = $id;
        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;
        return $this;
    }

    public function getInformationPro(): ?InformationPro
    {
        return $this->informationPro;
    }

    public function setInformationPro(?InformationPro $pro): self
    {
        $this->informationPro = $pro;
        return $this;
    }

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): self
    {
        $this->competence = $competence;
        return $this;
    }

    public function getInformationPersonelle(): ?InformationPersonelle
    {
        return $this->informationPersonelle;
    }

    public function setInformationPersonelle(?InformationPersonelle $perso): self
    {
        $this->informationPersonelle = $perso;
        return $this;
    }
}
