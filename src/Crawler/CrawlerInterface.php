<?php
namespace AflCrawler\Crawler;

interface CrawlerInterface
{
    public function crawl(string $html);
}
