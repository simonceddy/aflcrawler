<?php
namespace AflCrawler;

use Symfony\Component\DomCrawler\Crawler;

interface AflCrawler
{
    /**
     * Creates a Generator for the given Crawler.
     *
     * @param Crawler $crawler
     *
     * @return \Generator
     */
    public function crawl(Crawler $crawler);
}
