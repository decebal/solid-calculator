<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:34
 */

namespace Models;

use Contracts\InputAbstract;

class Input extends  InputAbstract
{
    /**
     * @param string $string
     */
    public function __construct($string = '')
    {
        $this->string = $string;
    }

    public function parseInput($string = '')
    {
        return parent::parseInput($string); // TODO: Change the autogenerated stub
    }

    public function validateInput($string = '')
    {
        return parent::validateInput($string); // TODO: Change the autogenerated stub
    }
}