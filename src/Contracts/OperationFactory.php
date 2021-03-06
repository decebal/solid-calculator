<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:07.
 */

namespace App\Contracts;

/**
 * Class OperationFactory.
 */
abstract class OperationFactory
{
    const MIN_PRIORITY = 1;

    public $inversePriority = 1;
    public static $sign = '+';

    /**
     * @return int
     */
    public function getInversePriority()
    {
        return $this->inversePriority;
    }

    /**
     * Late static binding for children.
     *
     * @return string
     */
    public static function getSign()
    {
        return static::$sign;
    }
}
