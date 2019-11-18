<?php

namespace spec\AflCrawler;

use AflCrawler\HttpClient;
use GuzzleHttp\Client;
use PhpSpec\ObjectBehavior;

class HttpClientSpec extends ObjectBehavior
{
    function let(Client $guzzle)
    {
        $this->beConstructedWith($guzzle);
    }
}
