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
}
