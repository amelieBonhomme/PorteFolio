<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Competence")]
class Competence
{
    #[ORM\Id]
    #[ORM\Column(name: 'IDcompetence', type: 'string', length: 50)]
    private string $IDcompetence;

    #[ORM\Column(name: 'logoLigne1', type: 'json', nullable: true)]
    private ?array $logoLigne1 = [];

    #[ORM\Column(name: 'logoLigne2', type: 'json', nullable: true)]
    private ?array $logoLigne2 = [];


    public function getIDcompetence(): ?string
    {
        return $this->IDcompetence;
    }

    public function getLogoLigne1(): ?array
    {
        return $this->logoLigne1;
    }

    public function setLogoLigne1(?array $logoLigne1): static
    {
        $this->logoLigne1 = $logoLigne1;

        return $this;
    }

    public function getLogoLigne2(): ?array
    {
        return $this->logoLigne2;
    }

    public function setLogoLigne2(?array $logoLigne2): static
    {
        $this->logoLigne2 = $logoLigne2;

        return $this;
    }
}
