<?php
namespace AflCrawler\Model;

class Roster implements ModelInterface
{
    protected $rosteredPlayers = [];

    /**
     * The season the roster is from.
     *
     * @var int
     */
    protected $season;

    /**
     * Get the season the roster is from.
     *
     * @return  int
     */ 
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set the season the roster is from.
     *
     * @param  int  $season  The season the roster is from.
     *
     * @return  self
     */ 
    public function setSeason(int $season)
    {
        $this->season = $season;

        return $this;
    }
}
