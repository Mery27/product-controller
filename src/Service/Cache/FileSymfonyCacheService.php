<?php

declare(strict_types=1);

namespace App\Service\Cache;

use App\Config\AppConfiguration;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Psr16Cache;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class FileSymfonyCacheService extends Psr16Cache
{
    /**
     * Default Cache item pool is set the symfony FileSystemAdapter
     */
    public function __construct(?CacheItemPoolInterface $pool = null)
    {
        if ($pool === null) {
            // Set default Symfony Cache Adapter
            $pool = new FilesystemAdapter(
                namespace: 'symfony_cache_product',
                defaultLifetime: 300,
                directory: AppConfiguration::pathToDir(AppConfiguration::CACHE_DIR));
            }

        parent::__construct($pool);
    }
}
