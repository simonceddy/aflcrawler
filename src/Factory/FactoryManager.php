<?php
namespace AflCrawler\Factory;

class FactoryManager
{
    protected $resolved = [];

    protected $factories;

    protected $group;

    public function __construct()
    {
        $conf = includeConfig();
        $this->group = $conf['use'];
        $this->factories = $conf['groups'][$this->group];
    }

    public function factory(string $name)
    {
        if (!isset($this->resolved[$name])) {
            $cn = $this->factories[$name] ?? false;
            if (!$cn) {
                throw new \InvalidArgumentException(
                    $name.' is not a valid factory name.'
                );
            }
            
            $this->resolved[$name] = new $cn;
        }
        return $this->resolved[$name];
    }
}

function includeConfig()
{
    return include dirname(__DIR__, 2).'/config/afl/factories.php';
}
