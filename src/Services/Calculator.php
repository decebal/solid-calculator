<?php namespace App\Services;

/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 22.02.2015
 * Time: 20:56
 */

use App\Contracts\CalculatorInterface;
use App\Contracts\InputAbstract;
use App\Contracts\OperationInterface;
use App\Contracts\OperationIteratorInterface;

class Calculator implements CalculatorInterface
{

    /**
     * @var null
     */
    protected $input = null;
    protected $operationsQueue = array();

    function __construct(InputAbstract $input, OperationIteratorInterface $iterator)
    {
        $this->input = $input;
        $this->operationsQueue = $iterator->getOperationsByPriority();
    }


    /**
     *
     * @return float
     */
    function compute()
    {
        $this->operationsQueue->top();
        $expression = $this->input->string;
        while ($this->operationsQueue->valid()) {
            $operation = $this->operationsQueue->extract();
            $expression = $this->computeLine($expression, $operation);
        }

        return $expression;
    }


    /**
     * @param OperationInterface $operation
     * @param $expression
     *
     * @return mixed|void
     */
    function computeLine($expression, OperationInterface $operation = null)
    {
        $this->input->setString($expression);
        $inputArray = $this->input->parseInput();
        $inputIterator = $inputArray->getIterator();
        $newExpression = array();
        $currentSign = $operation::getSign();

        $memberA = 0;
        $computed = array();

        //explore the operation members
        while ($inputIterator->valid()) {
            //compute only if operator is present
            if ($this->input->isOperator($inputIterator->current())) {
                $operator = $inputIterator->current();

                //get next element after the operator
                $inputIterator->next();
                $memberB = $inputIterator->key();

                if ($currentSign === $operator) {
                    //compute and mark members as computed
                    $newExpression[] = $operation->compute($inputArray[$memberA], $inputArray[$memberB]);
                    $computed[$memberA] = true;
                    $computed[$memberB] = true;
                } else {
                    //add elements not ready to be computed back to the expression
                    if (!isset($computed[$memberA])) {
                        $newExpression[] = $inputArray[$memberA];
                    }
                    $newExpression[] = $operator;
                }

                $memberA = $memberB;
            } else {
                $memberA = $inputIterator->key();
            }

            $inputIterator->next();

            //add last element from expression
            if (!$inputIterator->valid()
                && !isset($computed[$memberA])
            ) {
                $newExpression[] = $inputArray[$memberA];
            }
        }

        return join('', $newExpression);
    }

}