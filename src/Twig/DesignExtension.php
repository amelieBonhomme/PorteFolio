<?php
namespace App\Twig;

use App\Entity\Designe;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class DesignExtension extends AbstractExtension implements GlobalsInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getGlobals(): array
    {
        $design = $this->em->getRepository(Designe::class)->find('designe002');

        return [
            'couleurFond' => $design ? $design->getCouleurFond() : '#EBBFA9',
            'couleurTexte' => $design ? $design->getCouleurTexteGeneral() : '#000000',
            'imagePrincipale' => $design ? $design->getImagePrincipale() : '',
        ];
    }
}
