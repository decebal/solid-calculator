<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:15
 */

namespace Contracts;

interface ComparatorInterface
{
    /**
     * @param mixed $a
     * @param mixed $b
     *
     * @return bool
     */
    public function compare($a, $b);
}