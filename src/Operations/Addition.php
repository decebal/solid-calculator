<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:06
 */

namespace Operations;

use Contracts\OperationFactory;

/**
 * Class Addition
 *
 * @package Operations
 */
class Addition extends OperationFactory
{
    public $sign = '+';
    public $inversePriority = 1;
}