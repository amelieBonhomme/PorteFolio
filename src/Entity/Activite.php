<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Activite
{
    #[ORM\Id]
    #[ORM\Column(length: 50)]
    private string $IDactivite;

    #[ORM\Column(length: 50)]
    private string $descriptionActivite;
}
