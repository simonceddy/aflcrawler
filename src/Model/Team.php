<?php
namespace AflCrawler\Model;

class Team implements ModelInterface
{
    /**
     * The team's city/location
     *
     * @var string
     */
    protected $city;

    /**
     * The team name
     *
     * @var string
     */
    protected $name;

    /**
     * The teams shortened name.
     *
     * @var string
     */
    protected $shortName;

    /**
     * The team's rosters
     *
     * @var array
     */
    protected $rosters = [];

    public function __construct(array $data = [])
    {
        // init data
    }

    /**
     * Get the team's city/location
     *
     * @return  string
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the team's city/location
     *
     * @param  string  $city  The team's city/location
     *
     * @return  self
     */ 
    public function setCity(string $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the team name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the team name
     *
     * @param  string  $name  The team name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the teams shortened name.
     *
     * @return  string
     */ 
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set the teams shortened name.
     *
     * @param  string  $shortName  The teams shortened name.
     *
     * @return  self
     */ 
    public function setShortName(string $shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get the team's rosters
     *
     * @return  array
     */ 
    public function getRosters()
    {
        return $this->rosters;
    }

    /**
     * Get a Roster by season
     *
     * @param integer $season
     * @return false|Roster
     */
    public function getRoster(int $season)
    {
        return $this->rosters[$season] ?? false;
    }
    
    /**
     * Checks if a Roster exists for the given season
     *
     * @param integer $season
     * @return false|Roster
     */
    public function hasRoster(int $season)
    {
        return isset($this->rosters[$season]);
    }

    /**
     * Add a roster.
     * 
     * Throws an InvalidArgumentException if the given Roster's season is
     * already assigned.
     *
     * @param Roster $roster
     * @return self
     * 
     * @throws \InvalidArgumentException
     */
    public function addRoster(Roster $roster)
    {
        $season = $roster->getSeason();
        if (isset($this->rosters[$season])) {
            throw new \InvalidArgumentException(
                'A roster is already set for season '.$season
            );
        }
        $this->rosters[$season] = $roster;
        return $this;
    }
}
