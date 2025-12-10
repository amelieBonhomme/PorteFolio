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
        \App\Twig\AccesBDDPageTwig $accesBDD // ⚡ injection de ton extension
    ): Response {
        $personnes = $em->getRepository(InformationPersonelle::class)->findAll();

        $personId = $request->query->get('personId');
        $numero   = $personId && strlen($personId) >= 3 ? substr($personId, -3) : '001';

        // ⚡ transmettre le numéro à l’extension
        $accesBDD->setNumero($numero);

        return $this->render('home/accueil.html.twig', [
            'personnes' => $personnes,
            'numero'    => $numero,
        ]);
    }

}
