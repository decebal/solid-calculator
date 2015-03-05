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
        $expression = $this->input->string;
        $this->expressionBuffer = $this->input->parseInput();

        while ($this->operationsQueue->valid()) {
            $operation = $this->operationsQueue->extract();
            $this->computeLine($operation);
        }

        //@TODO get result
        return join('', $this->expressionBuffer->getArrayCopy());
    }


    /**
     * @param OperationInterface $operation
     *
     * @return mixed|void
     */
    function computeLine(OperationInterface $operation = null)
    {
        $inputIterator = $this->expressionBuffer->getIterator();
        $newExpression = array();
        $currentSign = $operation::getSign();

        $memberA = 0;
        $computed = array();
        $processed = false;

        //explore the operation members
        while($inputIterator->valid()) {
            //compute only if operator is present
            if ($this->input->isOperator($inputIterator->current())) {
                $operator = $inputIterator->current();
                $operatorKey = $inputIterator->key();

                //get next element after the operator
                $inputIterator->next();
                $memberB = $inputIterator->key();

                if ($currentSign === $operator) {
                    //compute and mark members as computed
                    $newExpression = $operation->compute(
                        $this->expressionBuffer[$memberA],
                        $this->expressionBuffer[$memberB]
                    );

                    $computed[$memberA] = true;
                    $computed[$memberB] = true;
                    $computed[$operatorKey] = true;
                    $processed = true;
                } else {
                    //@is this needed anymore
                    //add elements not ready to be computed back to the expression
//                    if (!isset($computed[$memberA])) {
//                        $newExpression[] = $this->expressionBuffer[$memberA];
//                    }
//                    $newExpression[] = $operator;
                }

                $memberA = $memberB;
            } else {
                $memberA = $inputIterator->key();
            }

            $inputIterator->next();

            //@is this needed anymore
            //add last element from expression
//            if (!$inputIterator->valid()
//                && !isset($computed[$memberA])) {
//                $newExpression[] = $this->expressionBuffer[$memberA];
//            }

            if ($processed) {
                $this->updateBuffer($computed, $newExpression);
                break;
            }
        }

        //@TODO find a suitable position for this check
        //@TODO check if the operator is still present in the buffer
    }

    /**
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
}
