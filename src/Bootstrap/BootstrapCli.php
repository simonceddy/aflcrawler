<?php

namespace AflCrawler\Bootstrap;

use Pimple\Container;
use Symfony\Component\Console\Application;

class BootstrapCli
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function bootstrap(Application $app)
    {
        $app->addCommands([
            $this->container['command.season'],
        ]);

        return $app;
    }
}
