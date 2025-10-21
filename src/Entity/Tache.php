<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
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
}
