<?php
// src/Service/HackerNewsService.php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class HackerNewsService
{
    public function __construct(private HttpClientInterface $client) {}

    public function getLatestArticles(int $maxResults = 4): array
    {
        $response = $this->client->request('GET', 'https://feeds.feedburner.com/TheHackersNews');
        $xml = simplexml_load_string($response->getContent());

        if (!$xml || !isset($xml->channel->item)) {
            return [];
        }

        $articles = [];
        $count = 0;
        foreach ($xml->channel->item as $item) {
            if ($count++ >= $maxResults) break;

            $articles[] = [
                'title' => (string) $item->title,
                'link' => (string) $item->link,
                'pubDate' => (string) $item->pubDate,
                'description' => (string) $item->description,
            ];
        }

        return $articles;
    }
}


