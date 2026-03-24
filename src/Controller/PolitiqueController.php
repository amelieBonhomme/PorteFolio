<?php

// src/Controller/VeilleController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PolitiqueController extends AbstractController
{
    #[Route('/politique_confidentialite', name: 'politique_confidentialite')]
    public function politiqueConfidentialite(): Response
    {
        return $this->render('home/politique_confidentialite.twig');
    }
}




