<?php

namespace App\Controller;

use App\Services\Calculator;
use App\Services\Input;
use App\Services\OperationIterator;

class CalculatorController
{
    public function compute($string)
    {
        $iterator = new OperationIterator();
        $input = new Input($string, $iterator);
        $calculator = new Calculator($input, $iterator);

        return $calculator->compute();
    }
}
