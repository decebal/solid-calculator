<?php namespace App\Controller;

use App\Models\Graph;
use App\Models\Input;
use App\Models\OperationIterator;

class Calculator
{

    public function compute($string)
    {
        $input = new Input($string, new OperationIterator());
        $inputArray = $input->parseInput();
        $inputIterator = $inputArray->getIterator();
        $memberA = '';

        $operations = $input->iterator->getOperationsByPriority();

        while ($inputIterator->valid()) {
            if ($input->isOperator($inputIterator->current())) {
                $operator = $inputIterator->current();

                $inputIterator->next();
                $memberB = $inputIterator->current();

                $operationInstance = new $operations[$operator]();

                $memberA = $operationInstance->compute($memberA, $memberB);
            } else {
                $memberA = $inputIterator->current();
            }

            $inputIterator->next();
        }

        return $memberA;
    }

}
