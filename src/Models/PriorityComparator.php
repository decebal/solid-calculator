<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:19
 */

namespace App\Models;
use App\Contracts\ComparatorInterface;

class PriorityComparator implements ComparatorInterface
{
    /**
     *
     * {@inheritdoc}
     */
    public function compare($a, $b)
    {
        if ($a['inversePriority'] > $b['inversePriority']) {
            return 0;
        } else {
            return 1;
        }
    }
}