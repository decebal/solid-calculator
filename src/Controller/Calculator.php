<?php namespace App\Controller;

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
        $previous = '';
        $lastOperatorPriority = 9;

        $operations = $input->iterator->getOperationsByPriority();
        $operatorsByPriority = array_flip(array_keys($operations));

        while($inputIterator->valid()) {
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
    }

}
