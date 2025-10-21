<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PAdmin
{
    #[ORM\Id]
    #[ORM\Column(length: 50)]
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
}
