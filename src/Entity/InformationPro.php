<?php
namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "informationpro")]
class InformationPro
{
    #[ORM\Id]
    #[ORM\Column(name: 'ID_pro', type: 'string', length: 50)]
    private string $ID_pro;

    #[ORM\Column(name: 'nomEntreprise',length: 255)]
    private string $nomEntreprise;

    #[ORM\Column(name: 'titrePoste', type: 'string')]
    private string $titrePoste;

    #[ORM\Column(name: 'logo', type: 'json', nullable: true)]
    private ?array $logo = [];

    #[ORM\Column(name: 'descriptionEntreprise1', type: 'string')]
    private string $descriptionEntreprise1;

    #[ORM\Column(name: 'lienSite', type: 'string')]
    private string $lienSite;

    #[ORM\Column(name: 'ordrepro',length: 255)]
    private ?string $ordrepro = null;

    public function getIDPro(): ?string
    {
        return $this->ID_pro;
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

    public function getlogo(): ?array
    {
        return $this->logo;
    }

    public function setlogo(?array $logo): static
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
    public function getOrdrepro(): ?string
    {
        return $this->ordrepro;
    }

    public function setOrdrepro(?string $ordrepro): static
    {
        $this->ordrepro = $ordrepro;
        return $this;
    }
}
