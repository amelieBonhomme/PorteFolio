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

    public function getAdmin(): ?PAdmin
    {
        return $this->admin;
    }

    public function setAdmin(?PAdmin $admin): static
    {
        $this->admin = $admin;

        return $this;
    }

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): static
    {
        $this->competence = $competence;

        return $this;
    }
}
