<?php

namespace spec\AflCrawler\Bootstrap;

use AflCrawler\Bootstrap\BootstrapCli;
use AflCrawler\HttpClient;
use PhpSpec\ObjectBehavior;
use Pimple\Container;
use Prophecy\Argument;
use Symfony\Component\Console\Application;

class BootstrapCliSpec extends ObjectBehavior
{
    function let(Container $c)
    {
        $c->offsetGet('client')->willReturn(new HttpClient());
        $this->beConstructedWith($c);
    }

    function it_adds_commands_to_the_cli_app(Application $app)
    {
        $app->addCommands(Argument::any())->shouldBeCalled();
        $this->bootstrap($app);
    }
}
