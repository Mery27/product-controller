<?php

declare(strict_types=1);

namespace App\Config;

class AppConfiguration
{
    
    const APP_DIR = "/src";

    /**
     * Select DB service for product data.
     * File must be in DATABASE_SERVICE_DIR
     */
    // const DATABASE_SERVICE = 'MySQLDatabaseService';
    const DATABASE_SERVICE = 'ElasticSearchDatabaseService';

    /**
     * Database dir as database namespace
     */
    const DATABASE_SERVICE_DIR = 'App\Service\Database';
    
    /**
     * Select cache service for caching product
     * File must be in CACHE_SERVICE_DIR
     */
    const CACHE_SERVICE = 'FileSimpleCacheService';
    // const CACHE_SERVICE = 'FileSymfonyCacheService';

    /**
     * Cache dir as cache namespace
     */
    const CACHE_SERVICE_DIR = 'App\Service\Cache';

    /**
     * Dir where we saved cache files
     */
    const CACHE_DIR = '/var/cache';

    /**
     * Dir where we saved statistic file
     */
    const STATISTICS_DIR = '/var/stat';


    /**
     * Path to root
     * 
     * @return string
     */
    static function root(): string
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    /**
     * Path to app root
     * 
     * @return string
     */
    static function rootApp(): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . self::APP_DIR;
    }

    /**
     * Create absolute path to the dir.
     * 
     * @param string $dirPath Path to the dir statrt with "/" slash
     */
    static function pathToDir(string $dirPath): string
    {
        return self::root() . $dirPath;
    }

}
