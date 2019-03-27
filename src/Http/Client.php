<?php
namespace AflCrawler\Http;

use GuzzleHttp\Client as GuzzleClient;

class Client extends GuzzleClient
{
    public function __construct()
    {
        parent::__construct([
            'base_uri' => 'https://afltables.com/afl'
        ]);
    }

    public function getStats(int $season)
    {
        // validate season
        return $this->request('GET', '/stats/'.$season.'.html');
    }
}
