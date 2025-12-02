<?php
namespace App\Twig;

use App\Entity\Designe;
use App\Entity\InformationPersonelle;
use App\Entity\InformationPro;
use App\Entity\Competence;
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
        $centreInterets = [];
        if ($IP) {
            $images = $IP->getCentreInteretImg(); // tableau JSON
            $textesString = $IP->getCentreInteretTexte(); // chaîne "Texte1,Texte2,..."
            $textes = explode(',', $textesString); // transforme en tableau

            foreach ($images as $index => $img) {
                $centreInterets[] = [
                    'image' => $img,
                    'texte' => $textes[$index] ?? '' // associe texte par index
                ];
            }
        }
        $IPro = $this->em->getRepository(InformationPro::class)->find('Pro001');
        $Grouplogo = [];
        if ($IPro) {
            $images = $IPro->getlogo(); // tableau JSON

            foreach ($images as $index => $img) {
                $Grouplogo[] = [
                    'image' => $img,
                ];
            }
        }
        $Comp = $this->em->getRepository(Competence::class)->find('C001');
        $GrouplogoC1 = [];
        $GrouplogoC2 = [];
        if ($Comp) {
            $images1 = $Comp->getlogoLigne1(); // tableau JSON
            $images2 = $Comp->getlogoLigne2(); // tableau JSON

            foreach ($images1 as $index => $img) {
                $GrouplogoC1[] = [
                    'image' => $img,
                ];
            }
            foreach ($images2 as $index => $img) {
                $GrouplogoC2[] = [
                    'image' => $img,
                ];
            }
        }

        return [
            'couleurFond' => $design ? $design->getCouleurFond() : '#EBBFA9',
            'couleurTexte' => $design ? $design->getCouleurTexteGeneral() : '#000000',
            'imagePrincipale' => $design ? $design->getImagePrincipale() : '',
            'nom' => $IP ? $IP->getNom() : '',
            'prenom'=> $IP ? $IP->getPrenom() :'',
            'metier'=> $IP ? $IP->getMetier() :'',
            'ordrePerso'=> $IP ? $IP->getordrePerso() :'',
            'description'=> $IP ? $IP->getDescription() :'',
            'mail'=> $IP ? $IP->getMail() :'',
            'linkedin'=> $IP ? $IP->getLinkedin() :'',
            'tel'=> $IP ? $IP->getTelephone() :'',
            'localisationMap'=> $IP ? $IP->getlocalisationMap() :'',
            'couleurMotivationFooter'=> $design ? $design->getcouleurMotivationFooter() :'',
            'couleurTexteMotivationFooter'=> $design ? $design->getcouleurTexteMotivationFooter() :'',
            'couleurNavigation'=> $design ? $design->getcouleurNavigation() :'',
            'couleurTexteNavigation'=> $design ? $design->getcouleurTexteNavigation() :'',
            'centreInterets' => $centreInterets,
            'Grouplogo' => $Grouplogo,
            'nomEntreprise'=> $IPro ? $IPro->getnomEntreprise() :'',
            'titrePoste'=> $IPro ? $IPro->gettitrePoste() :'',
            'descriptionEntreprise1'=> $IPro ? $IPro->getdescriptionEntreprise1() :'',
            'lienSite'=> $IPro ? $IPro->getlienSite() :'',
            'ordrepro'=> $IPro ? $IPro->getordrepro() :'',
            'GrouplogoC1' => $GrouplogoC1,
            'GrouplogoC2' => $GrouplogoC2,
        ];
    }
}
