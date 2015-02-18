<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:07
 */

namespace Contracts;

/**
 * Class OperationFactory
 *
 * @package Contracts
 */
abstract class OperationFactory
{
    const MIN_PRIORITY = 1;

    public $inversePriority = 1;
    public $sign = '+';

    /**
     * @return int
     */
    public function getInversePriority()
    {
        return $this->inversePriority;
    }

    /**
     * @return string
     */
    public function getSign()
    {
        return $this->sign;
    }
}