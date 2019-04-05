<?php
namespace AflCrawler;

class Crawl
{
    private $client;

    private function requestHtml($arg, string $callback)
    {
        isset($this->client) ?: $this->client = new Http\Client();
        if (!method_exists($this->client, $callback)) {
            throw new \LogicException('Invalid client callback');
        }
        return call_user_func([$this->client, $callback], $arg);
    }

    public static function season($season)
    {
        $crawl = new self;
        $html = null;
        $crawler = new Crawler\SeasonTotalsCrawler();

        if (is_int($season)) {
            $crawler->setSeason($season);
            try {
                $html = $crawl->requestHtml($season, 'getSeason');
            } catch (\Exception $e) {
                throw $e;
            }
        } elseif(is_string($season) && file_exists($fn = realpath($season))) {
            try {
                $html = file_get_contents($fn);
            } catch (\Exception $e) {
                throw $e;
            }
        }
        if (!$html) {
            throw new \LogicException('Unable to locate season data');
        }


        return $crawler->crawl($html);
    }
}
