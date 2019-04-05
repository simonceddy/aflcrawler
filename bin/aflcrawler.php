<?php
use Symfony\Component\Console\Application;
use AflCrawler\Console;

require dirname(__DIR__).'/vendor/autoload.php';

$app = new Application('AFLCrawler', '0.0.1');

$app->addCommands([
    new Console\Fetch\Season(),
    new Console\Html\Season(),
    new Console\Html\Player(),
    new Console\Html\Matches()
]);

$app->run();
