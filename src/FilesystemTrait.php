<?php

declare(strict_types=1);

namespace App;

trait FilesystemTrait
{
    /**
     * Create dir if dont exists 
     */
    protected function createDir(string $dir): bool
    {
        if (!is_dir($dir)) {
            return mkdir($dir, recursive: true);
        }

        return false;
    }

    /**
     * Create empty file if dont exists wit empty data.
     * 
     * @param string $file Path to the file
     * @param mixed $data Default data which will be added to the new file
     * @param bool $serializeData If you want serialized default data for the new file
     */
    protected function createFile(string $file, mixed $data = [], bool $serializeData = false): bool
    {

        if ($serializeData === true) {
            $data = serialize($data);
        }

        if (!is_file($file)) {
            return (bool) file_put_contents($file, $data);
        }

        return false;
    }

    /**
     * Path to the file with the directory.
     * 
     * @param string $file Name of the file.
     * @param string $dir Name of the dir.
     * @return string Absolute path to the file
     */
    protected function pathToFile(string $file = null, string $dir = null): string
    {
        return $dir . '/' . $file;
    }

    /**
     * Read file
     * 
     * @return resource|bool
     */
    protected function readFile(string $file) 
    {
        return fopen($file, 'r');
    }
}
