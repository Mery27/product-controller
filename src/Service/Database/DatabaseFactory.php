<?php

declare(strict_types=1);

namespace App\Service\Database;

use App\ClassFactory;
use App\Config\AppConfiguration;

/**
 * According to the settings, it creates a service class and checks if there is a file for it and if it contains the required interface
 * 
 * Use const DATABASE_SERVICE_DIR from AppConfiguration file
 * 
 * Use const DATABASE_SERVICE from AppConfiguration file
 */
class DatabaseFactory
{
    private ?DatabaseServiceInterface $currentDatabase;

    public function __construct()
    {
        $this->currentDatabase = $this->selectDatabaseFromConfig();
    }

    /**
     * Return Database Service class from selected DB in app settings
     * 
     * @return ?DatabaseServiceInterface
     */
    public function getService(): ?DatabaseServiceInterface
    {
        return $this->currentDatabase;
    }

    /**
     * From ClassFactory create Database Service class selected in app configurations
     * 
     * @return ?DatabaseServiceInterface
     */
    private function selectDatabaseFromConfig(): ?DatabaseServiceInterface
    {

        $selectedClass = new ClassFactory(
            namespace: AppConfiguration::DATABASE_SERVICE_DIR,
            className: AppConfiguration::DATABASE_SERVICE,
            interface: DatabaseServiceInterface::class
        );

        return $selectedClass->getClass();
    }

}
