<?php

namespace App\Entity;

use App\Repository\activiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: activiteRepository::class)]
class Activite
{
    #[ORM\Id]
    #[ORM\Column(name: 'IDactivite', type: 'string', length: 50)]
    private string $IDactivite;


    #[ORM\Column(length: 50)]
    private string $descriptionActivite;

    public function getIDactivite(): ?string
    {
        return $this->IDactivite;
    }

    public function getDescriptionActivite(): ?string
    {
        return $this->descriptionActivite;
    }

    public function setDescriptionActivite(string $descriptionActivite): static
    {
        $this->descriptionActivite = $descriptionActivite;

        return $this;
    }
}



