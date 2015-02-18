<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:34
 */

namespace App\Models;

use App\Contracts\InputAbstract;
use App\Models\OperationIterator;

class Input extends  InputAbstract
{
    public $string;
    public $iterator;

    /**
     * @param string $string
     * @param OperationIterator $iterator
     */
    public function __construct($string = '', OperationIterator $iterator)
    {
        $this->string = $string;
        $this->iterator = $iterator;
    }

    /**
     * @param $keywords
     * @param $orderedStringMatches
     *
     * @return mixed
     */
    public static function convertPregResultsToArray($keywords, $orderedStringMatches)
    {
        foreach ($keywords as $matchKey => $matchValues) {
            if ($matchValues[0] && $matchValues[1] >= 0) {
                $orderedStringMatches[$matchValues[1]] = $matchValues[0];
            }
        }
        unset($matchValues);

        return $orderedStringMatches;
    }


    /**
     * @return \ArrayObject
     */
    public function parseInput()
    {
        preg_match_all("/([".join('\\', $this->iterator->getOperationSigns())."]+)?([0-9]*)/",
            $this->string,
            $keywords,
            PREG_OFFSET_CAPTURE
        );

        $orderedStringMatches = new \ArrayObject();
        $orderedStringMatches = self::convertPregResultsToArray($keywords[1], $orderedStringMatches);
        $orderedStringMatches = self::convertPregResultsToArray($keywords[2], $orderedStringMatches);
        $orderedStringMatches->ksort();

        return $orderedStringMatches;
    }

    public function validateInput()
    {
        return parent::validateInput();
    }

    public function isOperator($string = '')
    {
        $isOperator = false;
        $signs = $this->iterator->getOperationSigns();
        foreach($signs as $sign) {
            if ($sign === $string) {
                $isOperator = true;
                break;
            }
        }

        return $isOperator;
    }
}