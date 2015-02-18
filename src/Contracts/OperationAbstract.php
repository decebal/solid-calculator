<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 21:55
 */

namespace App\Contracts;

/**
 * Class OperationAbstract
 *
 * @package Contracts
 */
abstract class OperationAbstract
{
    public $inversePriority = 1;
    public $sign = '+';
}