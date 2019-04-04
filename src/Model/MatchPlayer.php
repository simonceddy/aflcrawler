<?php
namespace AflCrawler\Model;

class MatchPlayer implements ModelInterface
{
    /**
     * The Match object
     *
     * @var Match
     */
    protected $match;

    /**
     * The RosteredPlayer object
     *
     * @var RosteredPlayer
     */
    protected $rosteredPlayer;

    /**
     * The Player's match stats
     *
     * @var Statline
     */
    protected $matchStats;

    /**
     * Get the Match object
     *
     * @return  Match
     */ 
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set the Match object
     *
     * @param  Match  $match  The Match object
     *
     * @return  self
     */ 
    public function setMatch(Match $match)
    {
        $this->match = $match;

        return $this;
    }

    /**
     * Get the RosteredPlayer object
     *
     * @return  RosteredPlayer
     */ 
    public function getRosteredPlayer()
    {
        return $this->rosteredPlayer;
    }

    /**
     * Set the RosteredPlayer object
     *
     * @param  RosteredPlayer  $rosteredPlayer  The RosteredPlayer object
     *
     * @return  self
     */ 
    public function setRosteredPlayer(RosteredPlayer $rosteredPlayer)
    {
        $this->rosteredPlayer = $rosteredPlayer;

        return $this;
    }

    public function toArray()
    {
        
    }
}
