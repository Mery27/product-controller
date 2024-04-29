<?php

declare(strict_types=1);

namespace App\Service\Cache;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\Psr16Cache;

class RedisCacheService extends Psr16Cache
{
    public function __construct(\Psr\Cache\CacheItemPoolInterface $pool)
    {
        // $pool = new RedisAdapter();
    }
}
