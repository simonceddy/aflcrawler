<?php
namespace AflCrawler\Support\Traits;

trait HasFactories
{
    protected $factories = [];

    public function factory(string $name)
    {
        if (!isset($this->factories[$id = strtolower($name)])) {
            if (strpos($name, '-')) {
                $name = implode('', \array_map(function ($val) {
                    return ucfirst($val);
                }, explode('-', $name)));
            }
            if (!class_exists(
                $cn = 'AflCrawler\\Factory\\'.(ucfirst($name)).'Factory'
            )) {
                throw new \LogicException('Could not find '.$cn);
            }
            $this->factories[$id] = new $cn;
        }
        return $this->factories[$id];
    }
}
