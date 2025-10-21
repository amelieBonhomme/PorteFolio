<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Connaissance
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: PAdmin::class)]
    #[ORM\JoinColumn(name: 'IDAdmin', referencedColumnName: 'IDAdmin')]
    private PAdmin $admin;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Competence::class)]
    #[ORM\JoinColumn(name: 'IDcompetence', referencedColumnName: 'IDcompetence')]
    private Competence $competence;
}
