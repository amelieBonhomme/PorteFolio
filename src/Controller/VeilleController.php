<?php

namespace App\Controller;
use App\Service\YoutubeService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VeilleController extends AbstractController
{
    #[Route('/veille', name: 'veille')]
    public function index(YoutubeService $youtube): Response
    {
        $channelId = 'UCWedHS9qKebauVIK2J7383g';
        $videos = $youtube->getLatestVideos($channelId, 4);

        return $this->render('home/veille.html.twig', [
            'videos' => $videos,
        ]);
    }
}

