<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 21:58
 */

namespace App\Contracts;

/**
 * Class InputAbstract
 *
 * @package Contracts
 */
abstract class InputAbstract
{
    public $string = '';

    /**
     * @return \ArrayObject
     */
    public abstract function parseInput();

    /**
     * @return bool
     */
    public abstract function validateInput();

    /**
     * @return mixed
     */
    public final function removeWhiteSpaces()
    {
        return preg_replace('/\s+/', '', $this->string);
    }
}