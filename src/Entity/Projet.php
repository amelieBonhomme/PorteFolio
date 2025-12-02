<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Projet")]
class Projet
{
    #[ORM\Id]
    #[ORM\Column(name: 'IDprojet', type: 'string', length: 50)]
    private string $IDprojet;

    #[ORM\Column(name: 'titreP',length: 50)]
    private string $titreP;

    #[ORM\Column(name: 'pdf', type: 'json', nullable: true)]
    private ?array $pdf = [];

    public function getIDprojet(): ?string
    {
        return $this->IDprojet;
    }

    public function gettitreP(): ?string
    {
        return $this->titreP;
    }

    public function settitreP(string $titreP): static
    {
        $this->titreP = $titreP;

        return $this;
    }

    public function getpdf(): ?array
    {
        return $this->pdf;
    }

    public function setpdf(?array $pdf): static
    {
        $this->pdf = $pdf;

        return $this;
    }
}
