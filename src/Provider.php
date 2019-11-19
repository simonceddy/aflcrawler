<?php
namespace AflCrawler;

use Pimple\ServiceProviderInterface;
use Pimple\Container;
use GuzzleHttp\Client;
use Symfony\Component\Console\Application;

class Provider implements ServiceProviderInterface
{
    public function register(Container $c)
    {
        $c['client'] = function ($c) {
            return new HttpClient(
                new Client([
                    'base_uri' => $c['config']->get(
                        'http.base_uri',
                        'https://afltables.com/afl/'
                    )
                ])
            );
        };
        
        $c['cli'] = function () {
            return new Application('AFLCrawler', '0.2.1');
        };
    }
}
