<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class InformationPersonelle
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 50)]
    private string $IDInfoP;

    #[ORM\Column(length: 50)]
    private string $nom;

    #[ORM\Column(length: 50)]
    private string $prenom;

    #[ORM\Column(length: 50)]
    private string $description;

    #[ORM\Column(length: 50)]
    private string $mail;

    #[ORM\Column(length: 50)]
    private string $telephone;

    #[ORM\Column(length: 50)]
    private string $localisationMap;

    #[ORM\Column(length: 50)]
    private string $linkedin;

    #[ORM\Column(type: 'boolean')]
    private bool $infoPersoActif;

    #[ORM\Column(length: 50)]
    private string $centreInteretImg;

    #[ORM\Column(length: 50)]
    private string $centreInteretTexte;
}
