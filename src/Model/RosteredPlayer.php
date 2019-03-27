<?php
namespace AflCrawler\Model;

class RosteredPlayer implements ModelInterface
{
    /**
     * The Player
     *
     * @var Player
     */
    protected $player;

    /**
     * The Roster
     *
     * @var Roster
     */
    protected $roster;

    /**
     * The Player number
     *
     * @var int
     */
    protected $number;

    /**
     * The Player's stats for the season
     *
     * @var Statline
     */
    protected $seasonStats;

    /**
     * Get the Player
     *
     * @return  Player
     */ 
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set the Player
     *
     * @param  Player  $player  The Player
     *
     * @return  self
     */ 
    public function setPlayer(Player $player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get the Player number
     *
     * @return  int
     */ 
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the Player number
     *
     * @param  int  $number  The Player number
     *
     * @return  self
     */ 
    public function setNumber(int $number)
    {
        if (0 > $number) {
            throw new \InvalidArgumentException(
                'Player numbers cannot be negative.'
            );
        }
        $this->number = $number;

        return $this;
    }
}
