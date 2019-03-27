<?php
namespace AflCrawler\Factory;

use AflCrawler\Model\ModelInterface;
use AflCrawler\Model\Team;
use AflCrawler\Util\TeamResolver;

class TeamFactory implements FactoryInterface
{
    protected $teamResolver;

    public function __construct(TeamResolver $teamResolver = null)
    {
        $this->teamResolver = $teamResolver ?? new TeamResolver;
    }

    public function build(array $data): ModelInterface
    {
        $team = new Team;
        !isset($data['city']) ?: $team->setCity($data['city']);
        !isset($data['name']) ?: $team->setName($data['name']);
        !isset($data['short']) ?: $team->setShortName($data['short']);
        return $team;
    }
}
