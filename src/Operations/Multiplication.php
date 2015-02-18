<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:28
 */

namespace Operations;


use Contracts\OperationFactory;

class Multiplication extends OperationFactory
{
    public $sign = '*';
    public $inversePriority = 2;
}