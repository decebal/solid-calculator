<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:19
 */

namespace App\Models;
use App\Contracts\ComparatorInterface;
use App\Contracts\OperationInterface;

class PriorityComparator implements ComparatorInterface
{
    /**
     *
     * {@inheritdoc}
     */
    public function compare($aOperation, $bOperation)
    {
        $aOperation = new $aOperation();
        $bOperation = new $bOperation();

        if ($aOperation->getInversePriority() == $bOperation->getInversePriority()) {
            return 0;
        } else {
            return $aOperation->getInversePriority() > $bOperation->getInversePriority()
                ? -1
                : 1;
        }
    }
}