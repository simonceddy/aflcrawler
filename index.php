<?php
require __DIR__.'/vendor/autoload.php';

//dd($client);
/* $res = $client->request('GET', 'https://afltables.com/afl/stats/2018.html');
$html = $res->getBody()->getContents();
if (!is_dir(__DIR__.'/storage')) {
    mkdir(__DIR__.'/storage');
}
file_put_contents(__DIR__.'/storage/2018.html', $html); */

$html = file_get_contents(__DIR__.'/storage/2018.html');
$crawler = new AflCrawler\Crawler\SeasonTotalsCrawler;
$result = $crawler->crawl($html);
dd($crawler);
//dd(end($result)['model']);
