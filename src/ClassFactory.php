<?php

declare(strict_types=1);

namespace App;

use App\Config\AppConfiguration;
use App\Service\Database\Exception\FileNotFoundException;
use App\Service\Database\Exception\ClassInterfaceException;
use Exception;

/**
 * Return class which created from namespace, class name and required interface.
 * 
 * @param string $namespace Namepace of the class you want create
 * @param string $className Class name of the class you want create
 * @param ?string $interface Interface thah the class must have
 */
class ClassFactory
{
    private $currentClass = null;

    public function __construct(
        private string $namespace,
        private string $className,
        private ?string $interface
        )
    {
        try {
            $this->selectClass();
        } catch (FileNotFoundException $e) {
            echo $e->getMessage();
        } catch (ClassInterfaceException $e) {
            echo $e->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Returns the created class obejct
     */
    public function getClass()
    {
        return $this->currentClass;
    }

    /**
     * Create class object
     * 
     * @return bool|Exception Return true if class is created
     * @throws FileNotFoundException Return exeption if file with class name dont exists
     * @throws ClassInterfaceException Return exeption if file dont have required interface
     */
    private function selectClass(): bool
    {
        $dir = $this->dirFromNamespace($this->namespace);
        // Create path to class file
        $classFile = $dir . $this->className . '.php';
        // $classFile = $this->getClassPath($this->classDir, $this->className);
        // Check if file with class exists
        if (! @file_exists($classFile)) {
            throw new FileNotFoundException("File for the class name " .  $this->namespace . '\\' .  $this->className . " does not exists.");
        }
        
        // Inicialization class
        $classPath = $this->namespace . '\\' .  $this->className;
        $selectedClass = new $classPath();
        
        if ($this->interface) {
            // Check if class is has implementated required Interface
            if (! $selectedClass instanceof $this->interface) {
                throw new ClassInterfaceException("Class " . $selectedClass::class . " has no implemented $this->interface so it cant be used.");  
            }
        }

        $this->currentClass = $selectedClass;
        
        return true;
    }

    /**
     * Create path to the dir for the class from class namespace
     * 
     * @param string $namespace Class namespace
     * @return string Path to the class dir
     */
    private function dirFromNamespace(string $namespace): string
    {
        // From App\Service\Database
        // from namespace create path to dir
        $clearedNamespace = str_replace(['App'], [''], $namespace);
        // create absolute path
        $classDir = AppConfiguration::rootApp() . $clearedNamespace . '\\';
        
        return $classDir;
    }
}