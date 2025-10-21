<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PAdmin
{
    #[ORM\Id]
    #[ORM\Column(name: 'IDAdmin', type: 'string', length: 50)]
    private string $IDAdmin;

    #[ORM\Column(length: 50, unique: true)]
    private string $login;

    #[ORM\Column(length: 50)]
    private string $mdp;

    #[ORM\ManyToOne(targetEntity: Designe::class)]
    #[ORM\JoinColumn(name: 'IDdesigne', referencedColumnName: 'IDdesigne')]
    private ?Designe $designe = null;

    #[ORM\ManyToOne(targetEntity: InformationPro::class)]
    #[ORM\JoinColumn(name: 'ID_pro', referencedColumnName: 'ID_pro')]
    private ?InformationPro $informationPro = null;

    #[ORM\ManyToOne(targetEntity: InformationPersonelle::class)]
    #[ORM\JoinColumn(name: 'IDInfoP', referencedColumnName: 'IDInfoP')]
    private ?InformationPersonelle $informationPersonelle = null;

    public function getIDAdmin(): ?string
    {
        return $this->IDAdmin;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getDesigne(): ?Designe
    {
        return $this->designe;
    }

    public function setDesigne(?Designe $designe): static
    {
        $this->designe = $designe;

        return $this;
    }

    public function getInformationPro(): ?InformationPro
    {
        return $this->informationPro;
    }

    public function setInformationPro(?InformationPro $informationPro): static
    {
        $this->informationPro = $informationPro;

        return $this;
    }

    public function getInformationPersonelle(): ?InformationPersonelle
    {
        return $this->informationPersonelle;
    }

    public function setInformationPersonelle(?InformationPersonelle $informationPersonelle): static
    {
        $this->informationPersonelle = $informationPersonelle;

        return $this;
    }
}
