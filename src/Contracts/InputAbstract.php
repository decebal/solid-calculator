<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 21:58
 */

namespace Contracts;

/**
 * Class InputAbstract
 *
 * @package Contracts
 */
abstract class InputAbstract
{
    public $string = '';

    /**
     * @param string $string
     *
     * @return string
     */
    public function parseInput($string = '')
    {
        return $string;
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    public function validateInput($string = '')
    {
        return true;
    }

    /**
     * @param string $string
     *
     * @return mixed
     */
    public final function removeWhiteSpaces($string = '')
    {
        return preg_replace('/\s+/', '', $string);
    }
}