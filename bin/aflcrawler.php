<?php
use Symfony\Component\Console\Application;
use AflCrawler\Console\Fetch\Season as FetchSeason;
use AflCrawler\Console\Fetch\HtmlSeason as FetchHtmlSeason;

require dirname(__DIR__).'/vendor/autoload.php';

$app = new Application('AFLCrawler', '0.0.1');

$app->addCommands([
    new FetchSeason(),
    new FetchHtmlSeason()
]);

$app->run();
