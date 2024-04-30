<?php

declare(strict_types=1);

namespace App;

/**
 * Interface for the service factory which use ClassFactory and must return the service class
 */
interface ServiceFactoryInterface
{

    /**
     * Return the service class as specifi ServiceInterface
     * Example:
     * For DatabaseFactory must return class DatabaseServiceInterface
     * For CacheFactory must return class CacheServiceInterface
     *
     * @return object
     */
    public function getService();
}