<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 23.02.2015
 * Time: 00:00.
 */
namespace App\Contracts;

interface OperationIteratorInterface
{
    /**
     * @return array of math signs
     */
    public function getOperationSigns();

    /**
     * @return \SplPriorityQueue
     */
    public function getOperationsByPriority();
}
