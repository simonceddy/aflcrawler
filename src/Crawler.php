<?php
namespace AflCrawler;

use AflCrawler\Bootstrap\InitConfigFromFiles;
use Pimple\Container;

class Crawler
{
    /**
     * The Crawler Config instance
     *
     * @var Config
     */
    protected $config;

    /**
     * The Pimple Container instance
     *
     * @var Container
     */
    protected $container;

    public function __construct()
    {
        $this->container = new Container();

        $this->initConfig();

        $this->initProviders();
    }

    private function initProviders()
    {
        $this->container->register(new HttpProvider());
    }

    private function initConfig()
    {
        if (!file_exists($path = dirname(__DIR__) . '/config')) {
            throw new \LogicException(
                'Cannot locate the Crawler configuration.'
            );
        }

        $this->config = (new InitConfigFromFiles)->load($path);

        $this->container['config'] = function () {
            return $this->config;
        };
    }

    public function container()
    {
        return $this->container;
    }

    public function config(string $key = null, $default = null)
    {
        if ($key === null) {
            return $this->config;
        }

        return $this->config->get($key, $default);
    }
}
