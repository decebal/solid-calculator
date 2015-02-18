<?php
/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:42
 */

namespace App\Models;

use App\Operations;
/**
 * Class OperationIterator
 *
 * @package Models
 */
class OperationIterator
{

    public function getOperations($directory = null)
    {
        $classes = array();
        $iterator = new \DirectoryIterator($directory);

        foreach ($iterator as $info) {
            if ($info->isFile()) {
                $classes[] = $info->getBasename('.php');
            }
        }

        return $classes;
    }

    public function getOperationsDirectory()
    {
        $currentDir = dirname(__FILE__);

        return join(DIRECTORY_SEPARATOR, array(
            dirname($currentDir),
            'Operations'
        ));
    }

    public function getOperationSigns()
    {
        $operations = $this->getOperations($this->getOperationsDirectory());
        $signs = array();
        foreach ($operations as $operation) {
            $operationClass = "App\\Operations\\" .$operation;
            $signs[] = $operationClass::getSign();
        }

        return $signs;
    }
}