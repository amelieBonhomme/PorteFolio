<?php

namespace App\Entity;

use App\Repository\tacheRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: tacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: InformationPro::class)]
    #[ORM\JoinColumn(name: 'ID_pro', referencedColumnName: 'ID_pro')]
    private InformationPro $informationPro;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Activite::class)]
    #[ORM\JoinColumn(name: 'IDactivite', referencedColumnName: 'IDactivite')]
    private Activite $activite;

    public function getInformationPro(): ?InformationPro
    {
        return $this->informationPro;
    }

    public function setInformationPro(?InformationPro $informationPro): static
    {
        $this->informationPro = $informationPro;

        return $this;
    }

    public function getActivite(): ?Activite
    {
        return $this->activite;
    }

    public function setActivite(?Activite $activite): static
    {
        $this->activite = $activite;

        return $this;
    }
}




