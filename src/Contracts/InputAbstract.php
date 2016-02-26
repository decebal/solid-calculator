<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 21:58.
 */
namespace App\Contracts;

/**
 * Class InputAbstract.
 */
abstract class InputAbstract
{
    public $string = '';
    public $iterator = null;

    /**
     * @return \ArrayObject
     */
    abstract public function parseInput();

    /**
     * @return bool
     */
    abstract public function validateInput();

    /**
     * @param string $string
     */
    public function setString($string)
    {
        $this->string = $this->removeWhiteSpaces($string);
    }

    /**
     * @param string $string
     *
     * @return mixed
     */
    final public function removeWhiteSpaces($string = '')
    {
        return preg_replace('/\s+/', '', $string);
    }
}
