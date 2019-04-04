<?php
namespace AflCrawler\Model;

class Match implements ModelInterface
{
    /**
     * The Home Team
     *
     * @var [type]
     */
    protected $homeTeam;
    
    /**
     * The Away Team
     *
     * @var [type]
     */
    protected $awayTeam;

    protected $season;

    protected $round;

    public function toArray()
    {
        return [
            'homeTeam' => $this->homeTeam,
            'awayTeam' => $this->awayTeam,
            'season' => $this->season,
            'round' => $this->round,
        ];
    }
}
