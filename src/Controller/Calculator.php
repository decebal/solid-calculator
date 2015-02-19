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

        $operations = $input->iterator->getOperationsByPriority();
        $queue = new \SplPriorityQueue();
        while($inputIterator->valid()) {
            if ($input->isOperator($inputIterator->current())) {
                $operator = $inputIterator->current();

                $inputIterator->next();
                $memberB = $inputIterator->key();

                $operationInstance = new $operations[$operator]();
                $queue->insert(
                    array(
                        'operationInstance' => $operationInstance,
                        'firstMemberKey' => $memberA,
                        'secondMemberKey' => $memberB
                    ),
                    $operationInstance->getInversePriority()
                );

                $memberA = $inputIterator->key();
            } else {
                $memberA = $inputIterator->key();
            }

            $inputIterator->next();
        }

        $queue->top();
        $resetPair = array();
        $result = 0;
        while (!$queue->isEmpty()) {
            $value = $queue->extract();

            $operationInstance = new $value['operationInstance']();

            if (isset($resetPair[$value['firstMemberKey']])) {
                $inputArray[$value['firstMemberKey']] = $result;
                unset($resetPair[$value['firstMemberKey']]);
                foreach ($resetPair as $resetKey => $resetValue) {
                    unset($inputArray[$resetKey]);
                }
                unset($resetValue);
                $resetPair = array();
            } elseif (isset($resetPair[$value['secondMemberKey']])) {
                $inputArray[$value['secondMemberKey']] = $result;
                unset($resetPair[$value['secondMemberKey']]);
                foreach ($resetPair as $resetKey => $resetValue) {
                    unset($inputArray[$resetKey]);
                }
                unset($resetValue);
                $resetPair = array();
            }
            $result = $operationInstance->compute(
                $inputArray[$value['firstMemberKey']],
                $inputArray[$value['secondMemberKey']]
            );

            $resetPair[$value['firstMemberKey']] = 1;
            $resetPair[$value['secondMemberKey']] = 1;
        }

        return $result;
    }

}
