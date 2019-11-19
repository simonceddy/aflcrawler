<?php
namespace AflCrawler\Util;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

class MakeCrawler
{
    /**
     * Create a DomCrawler from a PSR7 Response
     *
     * @param ResponseInterface $response
     * @param string $filter
     *
     * @return Crawler
     */
    public static function fromResponse(
        ResponseInterface $response,
        string $filter = null
    ) {
        $crawler = new Crawler($response->getBody()->getContents());
        return $filter === null ? $crawler : $crawler->filter($filter);
    }
}
