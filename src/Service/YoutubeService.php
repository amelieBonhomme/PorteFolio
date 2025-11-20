<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class YoutubeService
{
    public function __construct(
        private HttpClientInterface $client,
        private string $apiKey
    ) {}

    public function getLatestVideos(string $channelId, int $maxResults = 4): array
    {
        $response = $this->client->request('GET', 'https://www.googleapis.com/youtube/v3/search', [
            'query' => [
                'key' => $this->apiKey,
                'channelId' => $channelId,
                'part' => 'snippet,id',
                'order' => 'date',
                'maxResults' => $maxResults,
            ],
        ]);

        $data = $response->toArray(false);

        return array_values(array_filter($data['items'] ?? [], fn($item) =>
            ($item['id']['kind'] ?? null) === 'youtube#video'
        ));
    }
}
