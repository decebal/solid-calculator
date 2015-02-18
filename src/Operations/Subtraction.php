<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:26
 */

namespace App\Operations;

use App\Contracts\OperationFactory;
use App\Contracts\OperationInterface;

/**
 * Class Subtraction
 *
 * @package Operations
 */
class Subtraction extends OperationFactory implements OperationInterface
{
    public static $sign = '-';
    public $inversePriority = 1;
}