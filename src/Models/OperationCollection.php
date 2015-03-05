<?php namespace App\Models;
    /**
     * Created by PhpStorm.
     * User: decebal
     * Date: 18.02.2015
     * Time: 22:14
     */

/**
 * Class OperationCollection
 *
 * @package Contracts
 */
class OperationCollection
{
    /**
     * @var \SplPriorityQueue containing OperationInterface items
     */
    private $operations = array();

    /**
     * @param array $operations array of instances of OperationInterface
     */
    public function __construct(array $operations = array())
    {
        $this->setOperations($operations);
    }

    /**
     * @return array
     */
    public function getOperations()
    {
        return $this->operations;
    }

    /**
     * @param array $operations
     */
    public function setOperations(array $operations = [])
    {
        $operationQueue = new \SplPriorityQueue();

        foreach ($operations as $operation) {
            $operationInstance = new $operation();
            $operationQueue->insert($operationInstance, $operationInstance->getInversePriority());
        }

        $this->operations = $operationQueue;
    }
}
