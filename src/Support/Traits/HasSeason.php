<?php
namespace AflCrawler\Support\Traits;

trait HasSeason
{
    /**
     * The Season the data is for
     *
     * @var int
     */
    protected $season;

    /**
     * Get the Season the data is for
     *
     * @return  int
     */ 
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set the Season the data is for
     *
     * @param  int  $season  The Season the data is for
     *
     * @return  self
     */ 
    public function setSeason(int $season)
    {
        $this->season = $season;

        return $this;
    }
}
