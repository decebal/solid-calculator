<?php

namespace spec\App\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CalculatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Controller\Calculator');
    }

    function it_returns_2_for_1_plus_1()
    {
        $this->compute('1+1')->shouldReturn((float)2);
    }

    function it_returns_6_for_2_multiply_by_3()
    {
        $this->compute('2*3')->shouldReturn((float)6);
    }

    function it_returns_10_for_120_divided_by_12()
    {
        $this->compute('120/12')->shouldReturn((float)10);
    }

    function it_returns_5_for_8_subtract_3()
    {
        $this->compute('8-3')->shouldReturn((float)5);
    }
}
