<?php
namespace AflCrawler;

use Symfony\Component\DomCrawler\Crawler;

interface AflCrawler
{
    public function crawl(Crawler $crawler);
}
