<?php

declare(strict_types=1);

namespace App\Service\Cache;

use App\Config\AppConfiguration;
use App\FilesystemTrait;
use Psr\SimpleCache\CacheInterface;

/**
 * File cache service.
 * 
 * @param string $nameCache Create own dir for this cache.
 */
class FileSimpleCacheService implements CacheInterface
{

    use FilesystemTrait;

    private string $cacheDir;

    public function __construct(private ?string $nameCache = null)
    {

        if ($nameCache === null) {
            $this->nameCache = 'product';
        }

        $this->cacheDir = AppConfiguration::pathToDir(AppConfiguration::CACHE_DIR . '/' . $this->nameCache);
        $this->createDir($this->cacheDir);
    }

    public function get(string $key, mixed $default = null): mixed
    {
        // Get data from file
        $value = file_get_contents($this->pathToFile($key, $this->cacheDir));
        // === false, $value can return null and this is legimit value
        return $value === false ? $default : unserialize($value);
    }

    public function set(string $key, mixed $value, null|int|\DateInterval $ttl = null): bool
    {        

        if ($ttl instanceof \DateInterval) {
            // @0 is 1.1.1970 in milliseconds so it is 0
            // DateInterval('PT1M') - P - period, T - time, 1M - 1 minute
            // DateInterval('P1Y1DT1H1M1S') - Y -year, D - day
            // ->add(new \DateInterval('P1Y1DT1H1M1S'));
            $ttl = (new \DateTime('@0'))->add($ttl)->getTimestamp();
        }

        // save data as $value to file with name as $key
        return (bool) file_put_contents($this->pathToFile($key, $this->cacheDir), serialize($value));
    }

    public function delete(string $key): bool
    {
        $file = $this->pathToFile($key, $this->cacheDir);
    
        return unlink($file);
    } 

    public function clear(): bool
    {
        $filesInCache = $this->getFilesFromCache();

        foreach ($filesInCache as $fileName) {
            $file = $this->pathToFile($fileName, $this->cacheDir);
            if (is_file($file)) {
                unlink($file);
            }
        }

        return false;
    }

    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        $values = [];

        foreach ($keys as $key) {
            $value = file_get_contents($this->pathToFile($key, $this->cacheDir));
            $values[$key] = $value === false ? $default : unserialize($value);
        }

        return $values;
    }

    public function setMultiple(iterable $values, null|int|\DateInterval $ttl = null): bool
    {
        foreach ((array) $values as $key => $value) {
            file_put_contents($this->pathToFile($key, $this->cacheDir), serialize($value));
        }

        return false;
    }

    public function deleteMultiple(iterable $keys): bool
    {
        return false;
    }

    public function has(string $key): bool
    {
        $filesInCache = $this->getFilesFromCache();
        if (! in_array($key, $filesInCache)) {

            return false;
        }

        return true;
    }

    /**
     * Get all name of files from cache directory without . and .. directory.
     * 
     * @return array
     */
    private function getFilesFromCache(): array
    {
        // Find all files from the cache directory
        $files = scandir($this->cacheDir);

        // Remove from array . and .. directory
        $files = array_diff($files, ['.', '..']);

        return $files;
    }
}
