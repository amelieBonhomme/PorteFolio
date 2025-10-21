<?php

namespace App\Entity;

use App\Repository\projetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: projetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\Column(name: 'IDprojet', type: 'string', length: 50)]
    private string $IDprojet;


    #[ORM\Column(length: 50)]
    private string $titreP;

    #[ORM\Column(length: 50)]
    private string $pdf;

    #[ORM\Column]
    private bool $projetActif;

    public function getIDprojet(): ?string
    {
        return $this->IDprojet;
    }

    public function getTitreP(): ?string
    {
        return $this->titreP;
    }

    public function setTitreP(string $titreP): static
    {
        $this->titreP = $titreP;

        return $this;
    }

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(string $pdf): static
    {
        $this->pdf = $pdf;

        return $this;
    }

    public function isProjetActif(): ?bool
    {
        return $this->projetActif;
    }

    public function setProjetActif(bool $projetActif): static
    {
        $this->projetActif = $projetActif;

        return $this;
    }
}


