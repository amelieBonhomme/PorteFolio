<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class InformationPro
{
    #[ORM\Id]
    #[ORM\Column(length: 50)]
    private string $ID_pro;

    #[ORM\Column(length: 50)]
    private string $nomEntreprise;

    #[ORM\Column(length: 50)]
    private string $titrePoste;

    #[ORM\Column(length: 50)]
    private string $logo;

    #[ORM\Column(length: 50)]
    private string $descriptionEntreprise1;

    #[ORM\Column(length: 50)]
    private string $lienSite;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $dateDebut;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column]
    private bool $infoProActif;
}
