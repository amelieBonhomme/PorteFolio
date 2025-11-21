<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Designe
{
    #[ORM\Id]
    #[ORM\Column(name: 'IDdesigne', type: 'string', length: 50)] // on précise car dans ma base de donnée j'utilise camelCase au lieu de snake_case
    private string $IDdesigne;

    #[ORM\Column(name: 'imagePrincipale', type: 'string', length: 100)] //ok
    private string $imagePrincipale;

    #[ORM\Column(name: 'couleurFond', type: 'string',length: 50)]// ok
    private string $couleurFond;

    #[ORM\Column(name: 'couleurMotivationFooter', type: 'string',length: 50)] //ok
    private string $couleurMotivationFooter;

    #[ORM\Column(name: 'couleurNavigation', type: 'string',length: 50, nullable: true)]
    private ?string $couleurNavigation = null;

    #[ORM\Column(name: 'couleurTexteGeneral', type: 'string',length: 50)] //ok
    private string $couleurTexteGeneral;

    #[ORM\Column(name: 'couleurTexteMotivationFooter', type: 'string',length: 50)] //ok
    private string $couleurTexteMotivationFooter;

    #[ORM\Column(name: 'couleurTexteNavigation', type: 'string',length: 50)]
    private string $couleurTexteNavigation;

    public function getIDdesigne(): ?string
    {
        return $this->IDdesigne;
    }

    public function getImagePrincipale(): ?string
    {
        return $this->imagePrincipale;
    }

    public function setImagePrincipale(string $imagePrincipale): static
    {
        $this->imagePrincipale = $imagePrincipale;

        return $this;
    }

    public function getCouleurFond(): ?string
    {
        return $this->couleurFond;
    }

    public function setCouleurFond(string $couleurFond): static
    {
        $this->couleurFond = $couleurFond;

        return $this;
    }

    public function getCouleurMotivationFooter(): ?string
    {
        return $this->couleurMotivationFooter;
    }

    public function setCouleurMotivationFooter(string $couleurMotivationFooter): static
    {
        $this->couleurMotivationFooter = $couleurMotivationFooter;

        return $this;
    }

    public function getCouleurNavigation(): ?string
    {
        return $this->couleurNavigation;
    }

    public function setCouleurNavigation(?string $couleurNavigation): static
    {
        $this->couleurNavigation = $couleurNavigation;

        return $this;
    }

    public function getCouleurTexteGeneral(): ?string
    {
        return $this->couleurTexteGeneral;
    }

    public function setCouleurTexteGeneral(string $couleurTexteGeneral): static
    {
        $this->couleurTexteGeneral = $couleurTexteGeneral;

        return $this;
    }

    public function getCouleurTexteMotivationFooter(): ?string
    {
        return $this->couleurTexteMotivationFooter;
    }

    public function setCouleurTexteMotivationFooter(string $couleurTexteMotivationFooter): static
    {
        $this->couleurTexteMotivationFooter = $couleurTexteMotivationFooter;

        return $this;
    }

    public function getCouleurTexteNavigation(): ?string
    {
        return $this->couleurTexteNavigation;
    }

    public function setCouleurTexteNavigation(string $couleurTexteNavigation): static
    {
        $this->couleurTexteNavigation = $couleurTexteNavigation;

        return $this;
    }
}
