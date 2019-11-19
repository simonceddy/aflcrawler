<?php
require __DIR__.'/vendor/autoload.php';

$app = include_once 'bootstrap/app.php';

// $res = $app['client']->getSeason(2019);

// $crawler = AflCrawler\Util\MakeCrawler::fromResponse($res, 'table');

// dd($crawler->nodeName());

dd($app);

$console = $app['cli'];

/* $app->addCommands([
    new Console\Fetch\Season(),
    new Console\Html\Season(),
    new Console\Html\Player(),
    new Console\Html\Matches()
]); */

$console->run();

