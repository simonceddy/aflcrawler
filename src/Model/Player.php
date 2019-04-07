<?php
namespace AflCrawler\Model;

class Player extends BaseModel implements ModelInterface, \JsonSerializable
{
    protected $fields = [
        'surname',
        'givenNames',
        'careerStats'
    ];

    /**
     * The player's surname
     *
     * @var string
     */
    protected $surname;

    /**
     * The player's given names
     *
     * @var string
     */
    protected $givenNames;

    /**
     * The Player's career stats
     *
     * @var Statline
     */
    protected $careerStats;

    public function __construct()
    {
        
    }

    /**
     * Get the player's surname
     *
     * @return  string
     */ 
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set the player's surname
     *
     * @param  string  $surname  The player's surname
     *
     * @return  self
     */ 
    public function setSurname(string $surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get the player's given names
     *
     * @return  string
     */ 
    public function getGivenNames()
    {
        return $this->givenNames;
    }

    /**
     * Set the player's given names
     *
     * @param  string  $givenNames  The player's given names
     *
     * @return  self
     */ 
    public function setGivenNames(string $givenNames)
    {
        $this->givenNames = $givenNames;

        return $this;
    }

    public function toArray()
    {
        return [
            'surname' => $this->surname,
            'given_names' => $this->givenNames,
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
