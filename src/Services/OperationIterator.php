<?php namespace App\Services;

/**
 * Created by PhpStorm.
 * User: decebal
 * Date: 18.02.2015
 * Time: 22:42
 */

use App\Contracts\OperationIteratorInterface;
use App\Models\OperationCollection;
use App\Operations;

/**
 * Class OperationIterator.
 */
class OperationIterator implements OperationIteratorInterface
{
    public $signs = [];
    public $flippedSigns = [];

    /**
     *
     */
    public function __construct()
    {
        $this->setOperationSigns();
    }

    /**
     * @param null $directory
     *
     * @return array
     */
    public static function getClassNamesFromDirectory($directory = null)
    {
        $classes = [];
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

        return implode(DIRECTORY_SEPARATOR, [
            dirname($currentDir),
            'Operations',
        ]);
    }

    public function getOperationSigns()
    {
        return $this->signs;
    }

    /**
     * Flip The signs array.
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

        $this->flippedSigns = $obj->getOperations();
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
     * Collect defined operation signs in an attribute
     */
    public function setOperationSigns()
    {
        $operations = $this->getClassNamesFromDirectory($this->getOperationsDirectory());
        $signs = array();
        foreach ($operations as $operation) {
            $operationClass = "App\\Operations\\" . $operation;
            $signs[$operationClass] = $operationClass::getSign();
        }

        $this->signs = $signs;
    }
}