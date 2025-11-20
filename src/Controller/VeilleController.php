<?php

// src/Controller/VeilleController.php
namespace App\Controller;

use App\Service\YoutubeService;
use App\Service\HackerNewsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VeilleController extends AbstractController
{
    #[Route('/veille', name: 'veille')]
    public function index(YoutubeService $youtube, HackerNewsService $hackerNews): Response
    {
        $channelId = 'UCWedHS9qKebauVIK2J7383g';
        $videos = $youtube->getLatestVideos($channelId, 4);
        $articles = $hackerNews->getLatestArticles(4);

        return $this->render('home/veille.html.twig', [
            'videos' => $videos,
            'articles' => $articles,
        ]);
    }
}



