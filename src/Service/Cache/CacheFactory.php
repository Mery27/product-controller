<?php

declare(strict_types=1);

namespace App\Service\Cache;

use App\ClassFactory;
use App\Config\AppConfiguration;
use Psr\SimpleCache\CacheInterface;

/**
 * According to the settings, it creates a service class and checks if there is a file for it and if it contains the required interface
 * 
 * Use const CACHE_SERVICE_DIR from AppConfiguration file
 * 
 * Use const CACHE_SERVICE from AppConfiguration file
 */
class CacheFactory
{

    private ?CacheInterface $currentCache;

    public function __construct()
    {
        $this->currentCache = $this->selectCacheFromConfig();
    }

    /**
     * Return Database Service class from selected cache in app settings
     * 
     * @return ?CacheInterface
     */
    public function getService(): ?CacheInterface
    {
        return $this->currentCache;
    }

    /**
     * From ClassFactory create Cache Service class selected in app configurations
     * 
     * @return ?CacheInterface
     */
    private function selectCacheFromConfig(): ?CacheInterface
    {
        $selectedClass = new ClassFactory(
            namespace: AppConfiguration::CACHE_SERVICE_DIR,
            className: AppConfiguration::CACHE_SERVICE,
            interface: CacheInterface::class
        );

        return $selectedClass->getClass();
    }


}
