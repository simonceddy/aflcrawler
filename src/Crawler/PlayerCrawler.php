<?php
namespace AflCrawler\Crawler;

use Symfony\Component\DomCrawler\Crawler;

class PlayerCrawler implements CrawlerInterface
{
    public function crawl(string $html)
    {
        $crawler = new Crawler($html);
        $filter = $crawler->filter('table');
        foreach ($filter as $node) {
            $this->crawlTable($node);
            dd();
        }
    }

    protected function crawlTable(\DOMNode $node)
    {
        foreach ($node->childNodes as $child) {
            if ($child->childNodes->count() < 3) {
                dump($child->textContent);
            } else {

                dump($child);
            }
        }
    }
}
