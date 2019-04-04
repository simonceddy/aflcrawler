<?php
namespace AflCrawler\Factory\Eloquent;

use AflCrawler\Model\ModelInterface;
use AflCrawler\Model\Eloquent\Team;
use AflCrawler\Factory\FactoryInterface;

class TeamFactory implements FactoryInterface
{
    public function build(array $data): ModelInterface
    {
        $team = new Team;
        !isset($data['city']) ?: $team->city = $data['city'];
        !isset($data['name']) ?: $team->name = $data['name'];
        !isset($data['short']) ?: $team->short = $data['short'];
        return $team;
    }
}
