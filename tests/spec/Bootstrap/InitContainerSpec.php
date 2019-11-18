<?php

namespace spec\AflCrawler\Bootstrap;

use AflCrawler\Bootstrap\InitContainer;
use PhpSpec\ObjectBehavior;

class InitContainerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InitContainer::class);
    }
}
