<?php
namespace AflCrawler;

use Pimple\Container;

class Crawler
{
    /**
     * The Pimple Container instance
     *
     * @var Container
     */
    protected $container;

    protected function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function container()
    {
        return $this->container;
    }

    public function config(string $key = null, $default = null)
    {
        if ($key === null) {
            return $this->container['config'];
        }

        return $this->container['config']->get($key, $default);
    }
}
