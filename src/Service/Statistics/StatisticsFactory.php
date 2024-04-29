<?php

declare(strict_types=1);

namespace App\Service\Statistics;

/**
 * Simple class factory, dont check if the class exists
 * 
 * @param string $statisticService Namespace of the class statistics service which will be used.
 */
class StatisticsFactory 
{
    public function __construct(private string $statisticService)
    {
    }

    public function getService(): StatisticsServiceInterface
    {
        $class = $this->statisticService;
        return new $class();
    }


}