<?php namespace App\Controller;

use App\Models\Input;
use App\Models\OperationIterator;

class Calculator
{

    public function compute($string)
    {
        $input = new Input($string, new OperationIterator());
        $inputArray = $input->parseInput();
        $expression = '';
        $operations = $input->iterator->getOperationsByPriority();
        foreach($inputArray as $expressionPart) {
            if ($input->isOperator($expressionPart)) {
                //get precedence
            }

            $expression .= $expressionPart;
            //get operator by sign
        }
    }

}
