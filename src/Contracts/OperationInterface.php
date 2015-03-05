<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 21:54.
 */

namespace App\Contracts;

/**
 * Interface OperationInterface.
 */
interface OperationInterface
{
    /**
     * @param string $memberA
     * @param string $memberB
     *
     * @return float
     */
    public function compute($memberA = '', $memberB = '');

    /**
     * @return int
     */
    public function getInversePriority();
}
