<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UrlTitleService
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getTitle(string $url): string
    {
        $response = $this->client->request(
            'GET',
            $url
        );
        $content = $response->getContent();
        $crawler = new Crawler($content);
        return $crawler->filterXPath('//title')->text();
        //todo: add sanitizing title
    }
}