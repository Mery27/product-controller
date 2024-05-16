<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Product\ProductService;
use App\Service\Statistics\StatisticService;

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
        // Used cache service to return product
        $product = $productService->getProductWithCache($id);

        // Create a file with statistics of total request for the product
        $statisticService = new StatisticService();
        $statisticService->setProductStatistics($product);

        // Create JSON ouput
        $product = json_encode($product);

        return $product;
    }
}