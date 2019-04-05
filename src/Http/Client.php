<?php
namespace AflCrawler\Http;

use GuzzleHttp\Client as GuzzleClient;

class Client extends GuzzleClient
{
    public function __construct()
    {
        parent::__construct([
            'base_uri' => 'https://afltables.com/afl/'
        ]);
    }

    public function getSeason(int $season)
    {
        // validate season
        return $this->request('GET', 'stats/'.$season.'.html');
    }

    public function getMatches(int $season)
    {
        // validate season
        return $this->request('GET', 'seas/'.$season.'.html');
    }

    public function getPlayer(string $name)
    {
        $a = substr($name, 0, 1);
        return $this->request('GET', 'stats/players/'.$a.'/'.$name.'.html');
    }

    public function ping(): bool
    {
        
        return false;
    }
}
