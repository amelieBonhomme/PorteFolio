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
        EntityManagerInterface $em,
        \App\Twig\AccesBDDPageTwig $accesBDD
    ): Response {
        // 🔹 1. Valeur par défaut = menu déroulant (001 si rien)
        $personId = $request->query->get('personId');
        $numero   = $personId && strlen($personId) >= 3 ? substr($personId, -3) : '001';

        // 🔹 2. Si un admin est connecté, on force son numéro
        $user = $this->getUser();
        if ($user instanceof \App\Entity\PAdmin) {
            $idAdmin = $user->getIDAdmin();   // ex: "Admin002"
            $numero  = substr($idAdmin, -3);  // ex: "002"
        }

        // 🔹 3. Transmettre à l’extension
        $accesBDD->setNumero($numero);

        // 🔹 4. Charger les entités
        $personnes = $em->getRepository(\App\Entity\InformationPersonelle::class)->findAll();

        return $this->render('home/accueil.html.twig', [
            'personnes' => $personnes,
            'numero'    => $numero,
        ]);
    }


}
