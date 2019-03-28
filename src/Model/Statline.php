<?php
namespace AflCrawler\Model;

class Statline implements ModelInterface
{
    /**
     * An array of valid keys for stats
     *
     * @var array
     */
    private static $valid = [
        'games',
        'kicks',
        'marks',
        'handballs',
        'disposals',
        'average_disposals',
        'goals',
        'behinds',
        'hitouts',
        'tackles',
        'rebound_50',
        'inside_50',
        'clearances',
        'clangers',
        'frees_for',
        'frees_against',
        'brownlow_votes',
        'contested_possessions',
        'uncontested_possessions',
        'contested_marks',
        'marks_inside_50',
        'one_percenters',
        'bounces',
        'goal_assists',
        'time_on_ground',
    ];

    /**
     * Stats
     *
     * @var array
     */
    protected $stats = [];

    /**
     * Get stats
     *
     * @return  array
     */ 
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * Set stats
     *
     * @param  array  $stats  Stats
     *
     * @return  self
     */ 
    public function setStats(array $stats)
    {
        $this->stats = array_filter($stats, function ($key) {
            return in_array($key, static::$valid);
        }, ARRAY_FILTER_USE_KEY);
        return $this;
    }
}
