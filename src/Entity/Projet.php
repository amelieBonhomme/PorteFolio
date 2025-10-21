<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Projet
{
    #[ORM\Id]
    #[ORM\Column(length: 50)]
    private string $IDprojet;

    #[ORM\Column(length: 50)]
    private string $titreP;

    #[ORM\Column(length: 50)]
    private string $pdf;

    #[ORM\Column]
    private bool $projetActif;
}
