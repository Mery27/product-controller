<?php

declare(strict_types=1);

namespace App\Service\Statistics;

interface StatisticsServiceInterface
{
    /**
     * For Product increment the statistics result.
     * 
     * @param array $product Insert array with product values
     */
    public function addData(array $product): bool;

    /**
     * Get data from the file
     * 
     * @param string $file File with statistics
     * @return array Return product values from file as array
     */
    public function getData(string $file): array;
    
    /**
     * Show data for output
     * 
     * @return array Return product values in array
     */
    public function showData(): array;

    /**
     * Seve data to the file
     * 
     * @return bool True if the data has been saved in file.
     */
    public function setData(): bool;

}