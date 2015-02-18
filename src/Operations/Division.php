<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:28
 */

namespace App\Operations;


use App\Contracts\OperationFactory;

/**
 * Class Division
 *
 * @package Operations
 */
class Division extends OperationFactory
{
    public static $sign = '/';
    public $inversePriority = 1;
}