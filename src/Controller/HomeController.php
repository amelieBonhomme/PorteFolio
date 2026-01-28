<?php

namespace App\Controller;

use App\Entity\InformationPersonelle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        Request $request,
        EntityManagerInterface $em
    ): Response {
        // 1. Récupérer toutes les personnes
        $personnes = $em->getRepository(InformationPersonelle::class)
                        ->findBy([], ['nom' => 'ASC']);

        if (!$personnes) {
            throw $this->createNotFoundException("Aucune personne trouvée.");
        }

        // 2. Récupérer la personne sélectionnée dans l’URL
        $selectedId = $request->query->get('personId');

        // 3. Si aucune sélection → prendre la première
        if ($selectedId) {
            $selectedPerson = $em->getRepository(InformationPersonelle::class)->find($selectedId);
        } else {
            $selectedPerson = $personnes[0];
        }

        if (!$selectedPerson) {
            $selectedPerson = $personnes[0];
        }

        return $this->render('home/accueil.html.twig', [
            'personnes' => $personnes,
            'selectedPersonId' => $selectedPerson->getId(),
        ]);
    }
}
