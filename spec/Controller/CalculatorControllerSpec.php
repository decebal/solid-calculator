<?php

namespace spec\App\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CalculatorControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Controller\CalculatorController');
    }

    function it_returns_2_for_1_plus_1()
    {
        $this->compute('1+1')->shouldReturn("2");
    }

    function it_returns_6_for_2_multiply_by_3()
    {
        $this->compute('2*3')->shouldReturn("6");
    }

    function it_returns_10_for_120_divided_by_12()
    {
        $this->compute('120/12')->shouldReturn("10");
    }

    function it_returns_5_for_8_subtract_3()
    {
        $this->compute('8-3')->shouldReturn("5");
    }

    function it_returns_5_for_expression()
    {
        $this->compute('2*2*2*1-1')->shouldReturn("5");
    }

    function it_returns_12_for_expression_2()
    {
        $this->compute('1+2*6-3/1/3')->shouldReturn("12");
    }
}
