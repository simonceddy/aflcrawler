<?php
namespace AflCrawler\Util;

class TeamResolver
{
    private $teams;

    private $aliases;

    public function __construct()
    {
        // resolve team data
        $this->locateData();
    }

    private function locateData()
    {
        $dir = dirname(__DIR__, 2);
        while (!file_exists($fn = $dir.'/config/teams.php')
            && $dir !== dirname($dir)
        ) {
            $dir = dirname($dir);
        }
        $data = includeData($fn);
        if (!is_array($data)
            || !isset($data['teams'])
            || !isset($data['aliases'])
        ) {
            throw new \LogicException(
                'Invalid team config.'
            );
        }
        $this->teams = $data['teams'];
        $this->aliases = $data['aliases'];
        !isset($data['historical']) ?: $this->historical = $data['historical'];
    }

    /**
     * Resolve a team.
     * 
     * Returns false if no team is resolved.
     *
     * @param string $team
     * @return array|bool
     */
    public function resolve(string $team)
    {
        switch ($team) {
            case isset($this->teams[strtoupper($team)]):
                $team = $this->teams[strtoupper($team)];
                break;
            case (isset($this->historical)
                && isset($this->historical[strtoupper($team)])
            ):
                $team = $this->historical[strtoupper($team)];
                break;
            case isset($this->aliases[strtolower($team)]):
                $team = $this->resolve($this->aliases[strtolower($team)]);
                break;
            default:
                $team = false;
        }
        return $team;
    }
}

function includeData(string $filepath)
{
    $loader = \Closure::fromCallable(function (string $filepath) {
        return include $filepath;
    });
    return $loader($filepath);
}