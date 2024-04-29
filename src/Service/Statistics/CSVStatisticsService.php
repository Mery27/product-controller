<?php

declare(strict_types=1);

namespace App\Service\Statistics;

use App\Service\statistics\AbstractService\FileStatisticsService;

class CSVStatisticsService extends FileStatisticsService
{

    const DEFAULT_FILE = 'stat';

    const DEFAULT_FILE_EXTENSION = 'csv';

    public function __construct()
    {
        parent::__construct();
    }

    public function addData(array $product): bool
    {
        $this->data = $this->editDataInFile($product);

        return true;
    }

    public function setData(): bool
    {
        return true;
    }

    public function showData(): array
    {
        return $this->data;
    }

    public function getData(string $file): array
    {
        return $this->data;
    }

    private function editDataInFile(array $data): iterable
    {
        // Edit CSV data
        $data = [1 => 10, 2 => 20, 3 => 30];

        return $data;
    }

}
