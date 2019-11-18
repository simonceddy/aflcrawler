<?php
namespace AflCrawler;

use GuzzleHttp\Client as Guzzle;

/**
 * Decorates GuzzleHttp\Client
 */
class HttpClient
{
    /**
     * The GuzzleHttp Client
     *
     * @var Guzzle
     */
    protected $guzzle;

    public function __construct(Guzzle $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->guzzle, $name)) {
            return call_user_func_array([$this->guzzle, $name], $arguments);
        }

        throw new \BadMethodCallException(
            "Undefined method: {$name}"
        );
    }

    public function getSeason(int $season)
    {
        // validate season
        return $this->request('GET', "stats/{$season}.html");
    }

    public function getMatches(int $season)
    {
        // validate season
        return $this->request('GET', "seas/{$season}.html");
    }

    public function getPlayer(string $name)
    {
        $a = substr($name, 0, 1);
        return $this->request('GET', "stats/players/{$a}/'{$name}.html");
    }

    public function ping(): bool
    {
        
        return false;
    }
}
