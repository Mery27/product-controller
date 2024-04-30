<?php

declare(strict_types=1);

namespace App\Service\Statistics\AbstractService;

use App\Config\AppConfiguration;
use App\FilesystemTrait;
use App\Service\statistics\StatisticsServiceInterface;

abstract class FileStatisticsService implements StatisticsServiceInterface
{
    use FilesystemTrait;

    const DEFAULT_FILE = 'stat';

    const DEFAULT_FILE_EXTENSION = 'txt';

    protected array $data = [];

    protected string $pathToFile;

    public function __construct(
        // protected ?string $file = self::DEFAULT_FILE . '.' . self::DEFAULT_FILE_EXTENSION,
        protected ?string $file = null,
        protected ?string $dir = null)
    {
        if ($dir === null) {
            $this->dir = AppConfiguration::pathToDir(AppConfiguration::STATISTICS_DIR);
        }

        if ($file === null) {
            // Set file name from
            $this->file = static::DEFAULT_FILE . '.' . static::DEFAULT_FILE_EXTENSION;
        }

        // Set absolute path to the statistics file
        $this->pathToFile = $this->pathToFile($this->file, $this->dir);

        // Create dir with file if dont exists
        $this->createDir($this->dir);
        $this->createFile($this->pathToFile, data: '', serializeData: false);
    }

    /**
     * Add data to the class variable $data
     * Save data as array
     * 
     */
    public function addData(array $data): bool
    {
        $this->data = $data;

        return true;
    }

    /**
     * Get data from file.
     * 
     * @param mixed $source Source of the data, File, DB ...
     */
    public function getData(string $file): array
    {   
        $data = file_get_contents($file);

        if (@unserialize($data) !== false) {
            return unserialize($data);
        }

        return $this->data;
    }
    
    // Return data from class vatiable $data
    public function showData(): array
    {
        return $this->data;
    }

    /**
     * Save data to the file
     */
    public function setData(): bool
    {
        return (bool) file_put_contents($this->pathToFile, $this->data);
    }

}
