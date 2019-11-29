<?php
namespace AflCrawler;

use AflCrawler\Bootstrap\BootstrapCli;
use AflCrawler\Console\Commands\FetchSeason;
use AflCrawler\Crawlers\SeasonCrawler;
use Pimple\ServiceProviderInterface;
use Pimple\Container;
use GuzzleHttp\Client;
use Symfony\Component\Console\Application;

class Provider implements ServiceProviderInterface
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function register(Container $c)
    {
        $c['client'] = function () {
            return new Client([
                'base_uri' => $this->config->get(
                    'app.base_uri',
                    'https://afltables.com/afl/'
                )
            ]);
        };

        $c['requester'] = function ($c) {
            return new Requester($c['client']);
        };

        $c['command.season'] = function ($c) {
            return new FetchSeason(
                $c['requester'],
                $c['crawler.season']
            );
        };

        $c['crawler.season'] = function ($c) {
            return new SeasonCrawler(
                $this->config->get('crawlers.season.cols', [])
            );
        };
        
        $c['cli'] = function ($c) {
            return (new BootstrapCli($c))->bootstrap(
                new Application(
                    $this->config->get('app.app_name', 'AFLCrawler'),
                    $this->config->get('app.app_version', '0.2.1')
                )
            );
        };
    }
}
