<?php
namespace AflCrawler\Factory\Basic;

use AflCrawler\Model\ModelInterface;
use AflCrawler\Model\Team;
use AflCrawler\Factory\FactoryInterface;

class TeamFactory implements FactoryInterface
{
    public function build(array $data): ModelInterface
    {
        $team = new Team;
        !isset($data['city']) ?: $team->setCity($data['city']);
        !isset($data['name']) ?: $team->setName($data['name']);
        !isset($data['short']) ?: $team->setShortName($data['short']);
        return $team;
    }
}
