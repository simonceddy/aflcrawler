<?php

namespace AflCrawler\Bootstrap;

use Pimple\Container;

class InitContainer
{
    public function initialise(Container $container = null)
    {
        
    }

    public function initialize(Container $container = null)
    {
        return $this->initialise($container);
    }
}
