<?php
namespace AflCrawler\Support\Traits;

use AflCrawler\Factory\FactoryManager;


trait HasFactories
{
    protected $factories;

    public function factory(string $name)
    {
        return $this->factories()->factory($name);
    }

    public function factories(): FactoryManager
    {
        isset($this->factories) ?: $this->factories = new FactoryManager();
        return $this->factories;
    }
}
