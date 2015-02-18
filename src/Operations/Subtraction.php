<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:26
 */

namespace Operations;

use Contracts\OperationFactory;

/**
 * Class Subtraction
 *
 * @package Operations
 */
class Subtraction extends OperationFactory
{
    public $sign = '-';
    public $inversePriority = 1;
}