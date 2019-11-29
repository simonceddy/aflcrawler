<?php

namespace spec\AflCrawler;

use AflCrawler\Requester;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;

class RequesterSpec extends ObjectBehavior
{
    function let(Client $guzzle)
    {
        $this->beConstructedWith($guzzle);
    }

    function it_contains_a_helper_method_for_requesting_a_season(
        Client $guzzle
    )
    {
        $guzzle->get("stats/2019.html")->willReturn(new Response());
        $this->beConstructedWith($guzzle);

        $this->getSeason(2019)->shouldBeAnInstanceOf(ResponseInterface::class);
    }
}
