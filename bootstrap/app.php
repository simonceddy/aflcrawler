<?php
// use AflCrawler\Bootstrap\InitConfigFromFiles;
use AflCrawler\Config;
use AflCrawler\Provider;
use Eddy\DotConfig\LoadConfigFromPaths;
use Pimple\Container;

$c = new Container();

$c['config'] = function () {
    if (!file_exists($path = dirname(__DIR__) . '/config')) {
        throw new \LogicException(
            'Cannot locate the Crawler configuration.'
        );
    }
    
    return (new LoadConfigFromPaths([
        'className' => Config::class
    ]))->load($path);
};

$c->register(new Provider($c['config']));

return $c;
