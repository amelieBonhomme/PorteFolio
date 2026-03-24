<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConditionController extends AbstractController
{
    #[Route('/condition_utilisation', name: 'condition_utilisation')]
    public function conditonUtilisation(): Response
    {
        return $this->render('home/condition_utilisation.twig');
    }
}




