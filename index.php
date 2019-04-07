<?php
require __DIR__.'/vendor/autoload.php';
/* 
$result = AflCrawler\Crawl::season(__DIR__.'/storage/2011.html');

dd($result['teams']['ge']->getRoster(2011)->getRosteredPlayer(14)); */

$crawler = new AflCrawler\Crawler\PlayerCrawler;
$html = file_get_contents(__DIR__.'/storage/Gary_Ablett1.html');

$result = $crawler->crawl($html);

dd($result);
