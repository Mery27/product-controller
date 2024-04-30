<?php

declare(strict_types=1);

namespace App\Service\Statistics;

use App\Service\Statistics\StatisticsFactory;

class StatisticService
{

    // public function __construct(StatisticsFactory $statisticsFactory)
    // {
    // }

    /**
     * Finding a product from database
     * 
     * @param string $id Product ID
     * @return array
     */
    public function setProductStatistics(array $product): void
    {
        // Process product statistics to the file
        $statFactory = new StatisticsFactory();
        // Load statisic service
        $stat = $statFactory->getService();
        // Increment data for specific id
        $stat->addData($product);
        // Save change to the file
        $stat->setData();
    }
}
