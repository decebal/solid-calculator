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

    public $signs = array();
    public $flippedSigns = array();

    /**
     *
     */
    public function __construct()
    {
        $this->setOperationSigns();
    }

    /**
     * @param null $directory
     * @return array
     */
    public static function getClassNamesFromDirectory($directory = null)
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

    protected function getOperationsDirectory()
    {
        $currentDir = dirname(__FILE__);

        return join(DIRECTORY_SEPARATOR, array(
            dirname($currentDir),
            'Operations'
        ));
    }

    public function getOperationSigns()
    {
        return $this->signs;
    }

    /**
     * Flip The signs array
     */
    public function setOperationsBySigns()
    {
        $this->flippedSigns = array_flip($this->signs);
    }

    /**
     * @return array
     */
    public function getOperationsBySigns()
    {
        if (empty($this->flippedSigns) && $this->signs) {
            $this->setOperationsBySigns();
        }

        return $this->flippedSigns;
    }

    protected function setOperationsByPriority()
    {
        $obj = new OperationCollection($this->getOperationsBySigns());
        $obj->setComparator(new PriorityComparator());

        $this->flippedSigns = $obj->sort();
    }

    /**
     * @return array
     */
    public function getOperationsByPriority()
    {
        if (empty($this->flippedSigns) && $this->signs) {
            $this->setOperationsByPriority();
        }

        return $this->flippedSigns;
    }


    /**
     *
     */
    public function setOperationSigns()
    {
        $operations = $this->getClassNamesFromDirectory($this->getOperationsDirectory());
        $signs = array();
        foreach ($operations as $operation) {
            $operationClass = "App\\Operations\\" .$operation;
            $signs[$operationClass] = $operationClass::getSign();
        }

        $this->signs = $signs;
    }
}