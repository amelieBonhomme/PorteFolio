<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VeilleController extends AbstractController
{
    #[Route('/veille', name: 'veille')] // comment elle va s'afficher dans l'url et le nom pour l'appeler
    public function index(): Response
    {
        return $this->render('home/veille.html.twig');
    }
}
