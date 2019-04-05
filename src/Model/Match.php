<?php
namespace AflCrawler\Model;

use AflCrawler\Support\Traits\HasSeason;

class Match implements ModelInterface
{
    use HasSeason;

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
