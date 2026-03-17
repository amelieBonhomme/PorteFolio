<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "document")]
class Document
{
    #[ORM\Id]
    #[ORM\Column(length: 50)]
    private ?string $id_pdf = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $pdf = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    #[ORM\JoinColumn(name: 'id_projet', referencedColumnName: 'id_projet', nullable: true)]
    private ?Projet $projet = null;

    #[ORM\ManyToOne(inversedBy: 'documents')]
    #[ORM\JoinColumn(name: 'id_competence', referencedColumnName: 'id_competence', nullable: true)]
    private ?Competence $competence = null;

    public function getIdPdf(): ?string
    {
        return $this->id_pdf;
    }

    public function setIdPdf(string $id): self
    {
        $this->id_pdf = $id;
        return $this;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(?string $pdf): self
    {
        $this->pdf = $pdf;
        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;
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
}
