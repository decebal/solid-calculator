<?php

namespace App\Services;

/*
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
    protected $operationsQueue = [];

    /**
     * @var \ArrayObject
     */
    protected $expressionBuffer = [];

    public function __construct(InputAbstract $input, OperationIteratorInterface $iterator)
    {
        $this->input = $input;
        $this->operationsQueue = $iterator->getOperationsByPriority();
    }

    /**
     * @return float
     */
    public function compute()
    {
        $this->operationsQueue->top();
        $this->expressionBuffer = $this->input->parseInput();

        while ($this->operationsQueue->valid()) {
            $operation = $this->operationsQueue->extract();
            $this->computeLine($operation);
        }

        return implode('', $this->expressionBuffer->getArrayCopy());
    }

    /**
     * @param OperationInterface $operation
     *
     * @return mixed|void
     */
    public function computeLine(OperationInterface $operation = null)
    {
        $inputIterator = $this->expressionBuffer->getIterator();

        $currentSign = $operation::getSign();

        $memberA = 0;
        $computed = [];
        $processed = false;
        $result = 0;

        //explore the operation members
        $inputIterator->rewind();
        while ($inputIterator->valid()) {
            //compute only if operator is present
            if ($this->input->isOperator($inputIterator->current())) {
                $operator = $inputIterator->current();
                $operatorKey = $inputIterator->key();

                //get next element after the operator
                $inputIterator->next();
                $memberB = $inputIterator->key();

                if ($currentSign === $operator) {
                    //compute and mark members as computed
                    $result = $operation->compute(
                        $this->expressionBuffer[$memberA],
                        $this->expressionBuffer[$memberB]
                    );

                    $computed[$memberA] = true;
                    $computed[$memberB] = true;
                    $computed[$operatorKey] = true;
                    $processed = true;
                }

                $memberA = $memberB;
            } else {
                $memberA = $inputIterator->key();
            }

            $inputIterator->next();

            if ($processed) {
                $this->updateBuffer($computed, $result);
                break;
            }
        }

        if ($this->hasMoreSigns($currentSign)) {
            $this->computeLine($operation);
        }
    }

    /**
     * Update Buffer Members.
     *
     * @param $computed
     * @param $newExpression
     */
    protected function updateBuffer($computed, $newExpression)
    {
        $aux = $this->expressionBuffer;

        $firstKey = false;
        foreach ($computed as $opKey => $confirm) {
            if ($confirm && $this->expressionBuffer[$opKey]) {
                if ($firstKey === false) {
                    $firstKey = $opKey;
                }

                unset($aux[$opKey]);
            }
        }
        $aux[$firstKey] = $newExpression;
        $aux->ksort();

        $this->expressionBuffer = new \ArrayObject($aux);
    }

    /**
     * Check current buffer for more signs
     * in order to decide a re-computation with the same operation.
     *
     * @param $currentSign
     *
     * @return bool
     */
    protected function hasMoreSigns($currentSign)
    {
        $bufferIterator = $this->expressionBuffer->getIterator();
        $redo = false;
        while ($bufferIterator->valid()) {
            if ($currentSign === $bufferIterator->current()) {
                $redo = true;
                break;
            }
            $bufferIterator->next();
        }

        return $redo;
    }
}
