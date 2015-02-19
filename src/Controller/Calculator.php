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
        $graph = array();
        while($inputIterator->valid()) {
            if ($input->isOperator($inputIterator->current())) {
                $operator = $inputIterator->current();

                $inputIterator->next();
                $memberB = $inputIterator->key();

                $operationInstance = new $operations[$operator]();
                $graph[$memberA][$memberB] = $operationInstance->getInversePriority();
                $graph[$memberB][$memberA] = $operationInstance->getInversePriority();

                $memberA = $inputIterator->key();
            } else {
                $memberA = $inputIterator->key();
            }

            $inputIterator->next();
        }
        $g = new Graph($graph);
        

        return $result;
    }

}
