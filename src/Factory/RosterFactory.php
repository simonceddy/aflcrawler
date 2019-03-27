<?php
namespace AflCrawler\Factory;

use AflCrawler\Model\ModelInterface;
use AflCrawler\Model\Roster;

class RosterFactory implements FactoryInterface
{
    public function build(array $data): ModelInterface
    {
        $roster = new Roster;
        
        return $roster;
    }
}
