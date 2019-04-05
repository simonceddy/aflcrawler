<?php
namespace AflCrawler\Model;

use AflCrawler\Support\Traits\HasSeason;

class Roster implements ModelInterface
{
    use HasSeason;

    /**
     * The RosteredPlayers
     *
     * @var RosteredPlayer[]
     */
    protected $rosteredPlayers = [];

    /**
     * The team that the Roster belongs to.
     *
     * @var Team
     */
    protected $team;

    /**
     * Get the team that the Roster belongs to.
     *
     * @return  Team
     */ 
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set the team that the Roster belongs to.
     *
     * @param  Team  $team  The team that the Roster belongs to.
     *
     * @return  self
     */ 
    public function setTeam(Team $team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get the RosteredPlayers
     *
     * @return  RosteredPlayer[]
     */ 
    public function getRosteredPlayers()
    {
        return $this->rosteredPlayers;
    }

    public function addRosteredPlayer(RosteredPlayer $rosteredPlayer)
    {
        $n = $rosteredPlayer->getNumber();
        if (!$n) {
            throw new \LogicException(
                'A number must be assigned!'
            );
        } elseif (isset($this->rosteredPlayers[$n])) {
            throw new \InvalidArgumentException(
                $n.' is already assigned!'
            );
        }
        if ($rosteredPlayer->getRoster() !== $this) {
            $rosteredPlayer->setRoster($this);
        }
        $this->rosteredPlayers[$n] = $rosteredPlayer;
        return $this;
    }

    public function getRosteredPlayer(int $number)
    {
        return $this->rosteredPlayers[$number] ?? false;
    }

    public function hasRosteredPlayer(int $number)
    {
        return isset($this->rosteredPlayers[$number]);
    }

    public function toArray()
    {
        
    }
}
