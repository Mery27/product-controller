<?php

declare(strict_types=1);

namespace App\Service\Statistics;

use App\Service\Statistics\AbstractService\FileStatisticsService;
use App\Service\Statistics\StatisticsServiceInterface;

/**
 * Service for saving statistics results to a txt file
 */
class PlainTextStatisticsService extends FileStatisticsService implements StatisticsServiceInterface
{

    const DEFAULT_FILE = 'plain_stat';

    const DEFAULT_FILE_EXTENSION = 'txt';

    public function __construct()
    {
        parent::__construct();
    }

    public function addData(array $data): bool
    {

        $data = $this->editDataInFile($data);

        if (! $data) {
            $this->data = [];
            return false;
        }

        $this->data = $data;
        
        return true;
    }

    public function setData(): bool
    {
        $file = $this->pathToFile;
        $data = serialize($this->data);

        return (bool) file_put_contents($file, $data);
    }

    public function showData(): array
    {
        $data = $this->data;
        
        if (! $data) {
            $data = $this->getData($this->pathToFile);
        }

        return $data;
    }

    public function getData(string $file): array
    {
        // $file = $file === null ? $this->pathToFile : $file;
        // if (! is_file($file)) {
        //     return false;
        // }

        $data = file_get_contents($file);

        return unserialize($data);
    }

    private function editDataInFile(array $data): iterable
    {

        $id = $data['id'];

        // Return unserialize data from file 
        $originalData = unserialize(file_get_contents($this->pathToFile));

        // If returned data is not array, create new empty array
        if (! is_array($originalData)) {
            $originalData = [];
        }

        // Check if $id exists for increment or create new id
        if (array_key_exists($id, $originalData)) {
            $originalData[$id] += 1;
        } else {
            $originalData[$id] = 1;
        }

        return $originalData;
    }

}
