<?php
namespace App\Twig;

use App\Entity\Designe;
use App\Entity\InformationPersonelle;
use App\Entity\InformationPro;
use App\Entity\Competence;
use App\Entity\Projet;
use App\Entity\PAdmin;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class AccesBDDPageTwig extends AbstractExtension implements GlobalsInterface
{
    private EntityManagerInterface $em;
    private string $numero = '001';

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function setNumero(string $numero): void
    {
        $this->numero = $numero;
    }

    public function getGlobals(): array
    {
        $basePath = '/uploads/'.$this->numero.'/';
        // =========================
        // Design
        // =========================
        $design = $this->em->getRepository(Designe::class)->find('designe' . $this->numero);

        // =========================
        // Informations personnelles
        // =========================
        $IP = $this->em->getRepository(InformationPersonelle::class)->find('info'. $this->numero);
        $centreInterets = [];
        if ($IP) {
            $images = $IP->getCentreInteretImg();          // tableau JSON
            $textesString = $IP->getCentreInteretTexte();  // chaîne "Texte1,Texte2,..."
            $textes = explode(',', $textesString);         // transforme en tableau 

            foreach ($images as $index => $img) {
                $centreInterets[] = [
                    'image' => $basePath.$img,
                    'texte' => $textes[$index] ?? ''
                ];
            }
        }

        // =========================
        // Informations professionnelles
        // =========================
        $IPro = $this->em->getRepository(InformationPro::class)->find('pro'. $this->numero);
        $Grouplogo = [];
        if ($IPro) {
            foreach ($IPro->getlogo() as $img) {
                $Grouplogo[] = ['image' => $basePath.$img];
            }
        }

        // =========================
        // Compétences
        // =========================
        $Comp = $this->em->getRepository(Competence::class)->find('C'. $this->numero);
        $GrouplogoC1 = [];
        $GrouplogoC2 = [];
        if ($Comp) {
            foreach ($Comp->getlogoLigne1() as $img) {
                $GrouplogoC1[] = ['image' => $basePath.$img];
            }
            foreach ($Comp->getlogoLigne2() as $img) {
                $GrouplogoC2[] = ['image' => $basePath.$img];
            }
        }

        // =========================
        // Projets
        // =========================
        $P = $this->em->getRepository(Projet::class)->find('P'. $this->numero);
        $Grouppdf = [];
        if ($P) {
            $pdfs = $P->getPdf();                  // tableau JSON
            $titresString = $P->gettitreP();       // titres séparés par ";"
            $titres = explode(';', $titresString);

            foreach ($pdfs as $index => $pdf) {
                $Grouppdf[] = [
                    'file'  => $basePath.$pdf,
                    'titre' => $titres[$index] ?? ''
                ];
            }
        }

        // =========================
        // Admin
        // =========================
        $PA = $this->em->getRepository(PAdmin::class)->find('Admin'. $this->numero);

        // =========================
        // Retour des variables globales
        // =========================

        return [
            // Design
            'couleurFond'               => $design ? $design->getCouleurFond() : '#EBBFA9',
            'couleurTexte'              => $design ? $design->getCouleurTexteGeneral() : '#000000',
            'imagePrincipale'           => $design ? $design->getImagePrincipale() : '',
            'couleurMotivationFooter'   => $design ? $design->getcouleurMotivationFooter() : '',
            'couleurTexteMotivationFooter' => $design ? $design->getcouleurTexteMotivationFooter() : '',
            'couleurNavigation'         => $design ? $design->getcouleurNavigation() : '',
            'couleurTexteNavigation'    => $design ? $design->getcouleurTexteNavigation() : '',

            // Informations personnelles
            'nom'           => $IP ? $IP->getNom() : '',
            'prenom'        => $IP ? $IP->getPrenom() : '',
            'metier'        => $IP ? $IP->getMetier() : '',
            'ordrePerso'    => $IP ? $IP->getordrePerso() : '',
            'description'   => $IP ? $IP->getDescription() : '',
            'mail'          => $IP ? $IP->getMail() : '',
            'linkedin'      => $IP ? $IP->getLinkedin() : '',
            'tel'           => $IP ? $IP->getTelephone() : '',
            'localisationMap' => $IP ? $IP->getlocalisationMap() : '',
            'photo' => $IP && $IP->getPhoto() ? $basePath.$IP->getPhoto()[0] : '',
            'centreInterets'=> $centreInterets,

            // Informations professionnelles
            'nomEntreprise'         => $IPro ? $IPro->getnomEntreprise() : '',
            'titrePoste'            => $IPro ? $IPro->gettitrePoste() : '',
            'descriptionEntreprise1'=> $IPro ? $IPro->getdescriptionEntreprise1() : '',
            'lienSite'              => $IPro ? $IPro->getlienSite() : '',
            'ordrepro'              => $IPro ? $IPro->getordrepro() : '',
            'Grouplogo'             => $Grouplogo,

            // Compétences
            'GrouplogoC1' => $GrouplogoC1,
            'GrouplogoC2' => $GrouplogoC2,

            // Projets
            'titreP'    => $P ? $P->gettitreP() : '',
            'Grouppdf'  => $Grouppdf,

            // Admin
            'adminLogin' => $PA ? $PA->getLogin() : '',
            'adminId'    => $PA ? $PA->getIDAdmin() : '',
        ];
    }
}
