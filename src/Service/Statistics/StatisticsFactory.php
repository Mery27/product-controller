<?php

declare(strict_types=1);

namespace App\Service\Statistics;

use App\Config\AppConfiguration;
use App\ServiceFactoryInterface;

/**
 * Simple class factory, dont check if the class exists
 * 
 * @param string $statisticService Namespace of the class statistics service which will be used.
 */
class StatisticsFactory implements ServiceFactoryInterface
{
    public function __construct(private string $statisticService = AppConfiguration::STATISTICS_SERVICE_DIR . '\\' . AppConfiguration::STATISTICS_SERVICE)
    {
    }

    public function getService(): StatisticsServiceInterface
    {
        $class = $this->statisticService;
        return new $class();
    }
    
}