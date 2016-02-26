<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:28.
 */
namespace App\Operations;

use App\Contracts\OperationFactory;
use App\Contracts\OperationInterface;

/**
 * Class Division.
 */
class Division extends OperationFactory implements OperationInterface
{
    public static $sign = '/';
    public $inversePriority = 4;

    /**
     * @param string $memberA
     * @param string $memberB
     *
     * @return float
     */
    public function compute($memberA = '', $memberB = '')
    {
        return (float) $memberA / (float) $memberB;
    }
}
