<?php

namespace App\Twig;

use App\Entity\Designe;
use App\Entity\InformationPersonelle;
use App\Entity\InformationPro;
use App\Entity\Competence;
use App\Entity\Projet;
use App\Entity\Image;
use App\Entity\Document;
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

        // 🔥 2. Vérifier si un admin est connecté
        $adminConnecte = $request->getSession()->get('_security.last_username');

        if ($adminConnecte) {
            // On récupère l'admin connecté
            $admin = $this->em->getRepository(\App\Entity\PAdmin::class)
                            ->findOneBy(['login' => $adminConnecte]);

            if ($admin) {
                // On récupère SA fiche InformationPersonelle
                $IP = $this->em->getRepository(InformationPersonelle::class)
                            ->findOneBy(['admin' => $admin]);
            }
        }

        // 🔥 3. Si pas d’admin connecté → comportement normal
        if (!isset($IP)) {
            $selectedId = $request->query->get('personId');

            if ($selectedId) {
                $IP = $this->em->getRepository(InformationPersonelle::class)->find($selectedId);
            } else {
                $IP = $personnes[0]; // première personne par défaut
            }

            if (!$IP) {
                $IP = $personnes[0];
            }
        }

        // 4. Récupérer l’admin lié à cette personne
        $admin = $IP->getAdmin();

        // 5. Récupérer les autres données liées à cet admin
        $design = $this->em->getRepository(Designe::class)->findOneBy(['admin' => $admin]);
        $IPro   = $this->em->getRepository(InformationPro::class)->findOneBy(['admin' => $admin]);
        $Comp   = $this->em->getRepository(Competence::class)->findOneBy(['admin' => $admin]);
        $P      = $this->em->getRepository(Projet::class)->findOneBy(['admin' => $admin]);

        // … le reste de ton code ne change pas …



        // 6. Centre d’intérêt
        $centreInterets = [];
        foreach ($IP->getImages() as $image) {
            $centreInterets[] = [
                'image' => 'data:image/jpeg;base64,' . $image->getImg(),
                'texte' => $IP->getCentreInteretTexte(), // tu peux améliorer si tu veux un texte par image
            ];
        }

        // 7. Compétences
        $competenceLogos = [];
        if ($Comp) {
            foreach ($Comp->getImages() as $image) {
                $competenceLogos[] = [
                    'image' => 'data:image/jpeg;base64,' . $image->getImg()
                ];
            }
        }


        // 8. Projets
        $projets = [];
        $titresProjet = [];
        $fichiersProjet = [];

        if ($P) {
            // Séparer les titres par ";"
            if ($P->getTitreProjet()) {
                $titresProjet = array_map('trim', explode(';', $P->getTitreProjet()));
            }

            // Séparer les PDF par ";"
            foreach ($P->getDocuments() as $doc) {
                $fichiersProjet[] = 'data:application/pdf;base64,' . $doc->getPdf();
            }

            // Fusionner titres + fichiers par index
            foreach ($fichiersProjet as $i => $file) {
                $projets[] = [
                    'file'  => $file,
                    'titre' => $titresProjet[$i] ?? 'Projet sans titre'
                ];
            }
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
            'description'   => $IP->getDescription(),
            'mail'          => $IP->getMail(),
            'linkedin'      => $IP->getLinkedin(),
            'tel'           => $IP->getTelephone(),
            'localisationMap' => $IP->getLocalisationMap(),
            'photo' => $IP->getPhoto() ? 'data:image/jpeg;base64,' . $IP->getPhoto() : null,

            'centreInterets'=> $centreInterets,
            'centreInteretTexte' => $IP->getCentreInteretTexte(),


            // Informations professionnelles
            'nomEntreprise'         => $IPro?->getNomEntreprise(),
            'titrePoste'            => $IPro?->getTitrePoste(),
            'descriptionEntreprise'=> $IPro?->getDescriptionEntreprise(),
            'lienSite'              => $IPro?->getLienSite(),
            'imagesPro' => array_map(
                fn($img) => 'data:image/jpeg;base64,' . $img->getImg(),
                $IPro?->getImages()->toArray() ?? []
            ),


            // Compétences
            'Grouplogo' => $competenceLogos,

            // Projets
            'Grouppdf' => $projets,
            'GroupTitre' => $P?->getTitreProjet() ?? '',

        ];
    }
}
