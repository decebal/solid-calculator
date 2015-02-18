<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:06
 */

namespace App\Operations;

use App\Contracts\OperationFactory;
use App\Contracts\OperationInterface;

/**
 * Class Addition
 *
 * @package Operations
 */
class Addition extends OperationFactory implements OperationInterface
{
    public static $sign = '+';
    public $inversePriority = 1;
}