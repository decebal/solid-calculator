<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 22.02.2015
 * Time: 20:41.
 */

namespace App\Contracts;

interface CalculatorInterface
{
    /**
     * @return float
     */
    public function compute();

    /**
     * @param $expression
     *
     * @return mixed
     */
//    public function computeLine($expression);
}
