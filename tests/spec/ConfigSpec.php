<?php

namespace spec\AflCrawler;

use AflCrawler\Bootstrap\InitConfigFromFiles;
use AflCrawler\Config;
use PhpSpec\ObjectBehavior;

class ConfigSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough(function () {
            return (new InitConfigFromFiles)->load(
                dirname(__DIR__, 2) . '/config'
            );
        });
    }

    function it_contains_the_crawler_configuration()
    {
        $this->get('crawlers')->shouldBeArray();
    }
}
