<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Presente
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: PAdmin::class)]
    #[ORM\JoinColumn(name: 'IDAdmin', referencedColumnName: 'IDAdmin')]
    private PAdmin $admin;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Projet::class)]
    #[ORM\JoinColumn(name: 'IDprojet', referencedColumnName: 'IDprojet')]
    private Projet $projet;
}
