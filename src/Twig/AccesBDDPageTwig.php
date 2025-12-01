<?php
namespace App\Twig;

use App\Entity\Designe;
use App\Entity\InformationPersonelle;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class AccesBDDPageTwig extends AbstractExtension implements GlobalsInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getGlobals(): array
    {
        $design = $this->em->getRepository(Designe::class)->find('designe002');
        $IP = $this->em->getRepository(InformationPersonelle::class)->find('info001');

        return [
            'couleurFond' => $design ? $design->getCouleurFond() : '#EBBFA9',
            'couleurTexte' => $design ? $design->getCouleurTexteGeneral() : '#000000',
            'imagePrincipale' => $design ? $design->getImagePrincipale() : '',
            'nom' => $IP ? $IP->getNom() : '',
            'prenom'=> $IP ? $IP->getPrenom() :'',
            'metier'=> $IP ? $IP->getMetier() :'',
            'description'=> $IP ? $IP->getDescription() :'',
            'mail'=> $IP ? $IP->getMail() :'',
            'linkedin'=> $IP ? $IP->getLinkedin() :'',
            'tel'=> $IP ? $IP->getTelephone() :'',
            'localisationMap'=> $IP ? $IP->getlocalisationMap() :'',
            'couleurMotivationFooter'=> $design ? $design->getcouleurMotivationFooter() :'',
            'couleurTexteMotivationFooter'=> $design ? $design->getcouleurTexteMotivationFooter() :'',
            'couleurNavigation'=> $design ? $design->getcouleurNavigation() :'',
            'couleurTexteNavigation'=> $design ? $design->getcouleurTexteNavigation() :'',
            'centreInteretImg'=> $IP ? $IP->getcentreInteretImg() :'',
        ];
    }
}
