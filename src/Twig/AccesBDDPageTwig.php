<?php

namespace App\Twig;

use App\Entity\Designe;
use App\Entity\InformationPersonelle;
use App\Entity\InformationPro;
use App\Entity\Competence;
use App\Entity\Projet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class AccesBDDPageTwig extends AbstractExtension implements GlobalsInterface
{
    private EntityManagerInterface $em;
    private RequestStack $requestStack;

    public function __construct(EntityManagerInterface $em, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->requestStack = $requestStack;
    }

    public function getGlobals(): array
    {
        $request = $this->requestStack->getCurrentRequest();

        // 1. Récupérer toutes les personnes
        $personnes = $this->em->getRepository(InformationPersonelle::class)
                              ->findBy([], ['nom' => 'ASC']);

        if (!$personnes) {
            return [];
        }

        // 2. Récupérer la personne sélectionnée
        $selectedId = $request->query->get('personId');

        if ($selectedId) {
            $IP = $this->em->getRepository(InformationPersonelle::class)->find($selectedId);
        } else {
            $IP = $personnes[0]; // première personne par défaut
        }

        if (!$IP) {
            $IP = $personnes[0];
        }

        // 3. Récupérer l’admin lié à cette personne
        $admin = $IP->getAdmin();

        // 4. Récupérer les autres données liées à cet admin
        $design = $this->em->getRepository(Designe::class)->findOneBy(['admin' => $admin]);
        $IPro   = $this->em->getRepository(InformationPro::class)->findOneBy(['admin' => $admin]);
        $Comp   = $this->em->getRepository(Competence::class)->findOneBy(['admin' => $admin]);
        $P      = $this->em->getRepository(Projet::class)->findOneBy(['admin' => $admin]);

        // 5. Base path pour les fichiers
        $basePath = '/uploads/'.$admin->getId().'/';

        // 6. Centre d’intérêt
        $centreInterets = [];
        if ($IP) {
            $images = explode(',', $IP->getCentreInteretImg());
            $textes = explode(',', $IP->getCentreInteretTexte());

            foreach ($images as $i => $img) {
                $centreInterets[] = [
                    'image' => $basePath.$img,
                    'texte' => $textes[$i] ?? ''
                ];
            }
        }

        // 7. Compétences
        $competenceLogos = [];
        if ($Comp) {
            $logos = explode(',', $Comp->getLogoLigne());
            foreach ($logos as $logo) {
                $competenceLogos[] = ['image' => $basePath.$logo];
            }
        }

        // 8. Projet
        $projets = [];
        if ($P) {
            $projets[] = [
                'file'  => $basePath.$P->getPdf(),
                'titre' => $P->getTitreProjet()
            ];
        }

        return [
            'personnes' => $personnes,
            'selectedPerson' => $IP,

            // Design
            'couleurFond'               => $design?->getCouleurFond(),
            'couleurTexte'              => $design?->getCouleurTexteGeneral(),
            'imagePrincipale'           => $design?->getImagePrincipale(),
            'couleurMotivationFooter'   => $design?->getCouleurMotivationFooter(),
            'couleurTexteMotivationFooter' => $design?->getCouleurTexteMotivationFooter(),
            'couleurNavigation'         => $design?->getCouleurNavigation(),
            'couleurTexteNavigation'    => $design?->getCouleurTexteNavigation(),

            // Informations personnelles
            'nom'           => $IP->getNom(),
            'prenom'        => $IP->getPrenom(),
            'metier'        => $IP->getMetier(),
            'ordrePerso'    => $IP->getOrdrePerso(),
            'description'   => $IP->getDescription(),
            'mail'          => $IP->getMail(),
            'linkedin'      => $IP->getLinkedin(),
            'tel'           => $IP->getTelephone(),
            'localisationMap' => $IP->getLocalisationMap(),
            'photo'         => $basePath.$IP->getPhoto(),
            'centreInterets'=> $centreInterets,

            // Informations professionnelles
            'nomEntreprise'         => $IPro?->getNomEntreprise(),
            'titrePoste'            => $IPro?->getTitrePoste(),
            'descriptionEntreprise'=> $IPro?->getDescriptionEntreprise(),
            'lienSite'              => $IPro?->getLienSite(),
            'ordrepro'              => $IPro?->getOrdrePro(),

            // Compétences
            'Grouplogo' => $competenceLogos,

            // Projets
            'Grouppdf' => $projets,
        ];
    }
}
