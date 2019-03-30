<?php
namespace AflCrawler\Factory\Basic;

use AflCrawler\Model\ModelInterface;
use AflCrawler\Model\Roster;
use AflCrawler\Factory\FactoryInterface;

class RosterFactory implements FactoryInterface
{
    public function build(array $data): ModelInterface
    {
        $roster = new Roster;
        !isset($data['season']) ?: $roster->setSeason($data['season']);
        !isset($data['team']) ?: $roster->setTeam($data['team']);
        return $roster;
    }
}
