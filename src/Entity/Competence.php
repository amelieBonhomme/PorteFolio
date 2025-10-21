<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Competence
{
    #[ORM\Id]
    #[ORM\Column(length: 50)]
    private string $IDcompetence;

    #[ORM\Column(length: 50)]
    private string $logoLigne1;

    #[ORM\Column(length: 50)]
    private string $logoLigne2;

    #[ORM\Column]
    private bool $logoActif;
}
