<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 19.02.2015
 * Time: 03:39
 */

namespace App\Contracts;


class GraphAbstract {

    protected $graph;

    public function __construct($graph = array())
    {
        $this->graph = $graph;
    }
}