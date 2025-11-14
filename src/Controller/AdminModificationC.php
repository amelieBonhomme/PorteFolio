<?php
// transmet  le formulaire à la vue , indique la ligne à ajouter gère la soumission
namespace App\Controller;

use App\Entity\Designe;
use App\Entity\InformationPersonelle;
use App\Form\AdminFormDesigne;
use App\Form\AdminFormIP;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminModificationC extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function editAdmin(Request $request, EntityManagerInterface $em): Response
    {
        // Récupération des entités
        $design = $em->getRepository(Designe::class)->find('designe002');
        
        $IP = $em->getRepository(InformationPersonelle::class)->find('info001');

        if (!$design || !$IP) {
            throw $this->createNotFoundException('Design ou Information Personnelle introuvable.');
        }

        // Création des formulaires
        $designForm = $this->createForm(AdminFormDesigne::class, $design);
        $IPForm = $this->createForm(AdminFormIP::class, $IP);

        // Gestion des requêtes
        $designForm->handleRequest($request);
        $IPForm->handleRequest($request);

        // Traitement du formulaire de design
        if ($designForm->isSubmitted() && $designForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Design mis à jour avec succès !');
        }

        // Traitement du formulaire d’informations personnelles
        if ($IPForm->isSubmitted() && $IPForm->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Informations personnelles mises à jour avec succès !');
        }
        // Affichage de la vue
        return $this->render('home/admin.html.twig', [
            'designForm' => $designForm->createView(),
            'IPForm' => $IPForm->createView(),
            'couleurFond' => $design->getCouleurFond(),
            'couleurTexte' => $design->getCouleurTexteGeneral(),
            'imagePrincipale'=> $design->getImagePrincipale(),
            'nom'=> $IP->getNom(),
            'prenom'=> $IP->getPrenom(),
            'metier'=> $IP->getMetier(),
            'description'=> $IP->getDescription(),
            'mail'=> $IP->getMail(),
            'linkedin'=> $IP->getLinkedin(),
            'tel'=> $IP->getTelephone(),
            'localisationMap'=> $IP->getlocalisationMap(),
        ]);

    }
}
