<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 21:54
 */

namespace App\Contracts;

/**
 * Interface OperationInterface
 *
 * @package Contracts
 */
interface OperationInterface
{
    /**
     * @param string $expression
     * @return int
     */
    public function compute($expression = '');

    /**
     * @return int
     */
    public function getInversePriority();
}