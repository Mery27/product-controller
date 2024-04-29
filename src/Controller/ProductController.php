<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Cache\CacheFactory;
use App\Service\Product\ProductService;
use App\Service\Statistics\StatisticsFactory;
use App\Service\Statistics\CSVStatisticsService;
use App\Service\Statistics\PlainTextStatisticsService;

class ProductController
{

    /* public function __construct(
        ProductService $productService,
        CacheFactory $cache,
        StatisticFactory $statFactory
        ){}
    */

    /**
    * @param string $id
    * @return string
    */
    public function detail($id): string
    {
        // load product depends on the database service which is set on the settings
        // (from MySQL or ES)
        $productService = new ProductService();
        
        // Load cache service depends on the settings        
        $cache = new CacheFactory();

        // Used cache service to return product
        $product = $productService->getProductWithCache($id, $cache->getService());

        // Process product statistics to the file
        $statFactory = new StatisticsFactory(PlainTextStatisticsService::class);
        // Just dump statistics service which work, but dont return any data
        // $statFactory = new StatisticsFactory(CSVStatisticsService::class);
        
        // Load statisic service
        $stat = $statFactory->getService();
        // Increment data for specific id
        $stat->addData($product);
        // Save change to the file
        $stat->setData();

        // Create JSON ouput
        $product = json_encode($product);

        return $product;
    }
}