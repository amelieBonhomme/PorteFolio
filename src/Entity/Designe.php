<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Designe
{
    #[ORM\Id]
    #[ORM\Column(length: 50)]
    private string $IDdesigne;

    #[ORM\Column(length: 50)]
    private string $imagePrincipale;

    #[ORM\Column(length: 50)]
    private string $couleurFond;

    #[ORM\Column(length: 50)]
    private string $couleurMotivationFooter;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $couleurNavigation = null;

    #[ORM\Column(length: 50)]
    private string $couleurTexteGeneral;

    #[ORM\Column(length: 50)]
    private string $couleurTexteMotivationFooter;

    #[ORM\Column(length: 50)]
    private string $couleurTexteNavigation;
}
