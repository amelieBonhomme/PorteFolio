<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Competence
{
    #[ORM\Id]
    #[ORM\Column(name: 'IDcompetence', type: 'string', length: 50)]
    private string $IDcompetence;

    #[ORM\Column(length: 50)]
    private string $logoLigne1;

    #[ORM\Column(length: 50)]
    private string $logoLigne2;

    #[ORM\Column]
    private bool $logoActif;

    public function getIDcompetence(): ?string
    {
        return $this->IDcompetence;
    }

    public function getLogoLigne1(): ?string
    {
        return $this->logoLigne1;
    }

    public function setLogoLigne1(string $logoLigne1): static
    {
        $this->logoLigne1 = $logoLigne1;

        return $this;
    }

    public function getLogoLigne2(): ?string
    {
        return $this->logoLigne2;
    }

    public function setLogoLigne2(string $logoLigne2): static
    {
        $this->logoLigne2 = $logoLigne2;

        return $this;
    }

    public function isLogoActif(): ?bool
    {
        return $this->logoActif;
    }

    public function setLogoActif(bool $logoActif): static
    {
        $this->logoActif = $logoActif;

        return $this;
    }
}
