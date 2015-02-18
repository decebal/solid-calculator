<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:28
 */

namespace App\Operations;


use App\Contracts\OperationFactory;
use App\Contracts\OperationInterface;

class Multiplication extends OperationFactory implements OperationInterface
{
    public static $sign = '*';
    public $inversePriority = 2;
}