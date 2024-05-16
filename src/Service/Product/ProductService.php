<?php

declare(strict_types=1);

namespace App\Service\Product;

use App\Service\Cache\CacheFactory;
use App\Service\Database\DatabaseFactory;

class ProductService
{

    /**
     * Finding a product from database
     * 
     * @param string $id Product ID
     * @return array
     */
    public function getProduct(string $id): array
    {
        // Load database factory, which load database service from config class
        $databaseFactory = new DatabaseFactory();
        $repository = $databaseFactory->getService();

        // TODO: remove in prod
        // Source product data, only for test purpose
        echo('Data loaded from DB ' . $repository::class) . '<br />';

        return $repository->getProductById($id);
    }

    /**
     * Finding a product using a cache service
     * 
     * @param string $id Product ID
     * @return array
     */
    public function getProductWithCache(string $id): array
    {
        // Load cache service depends on the settings        
        $cacheFactory = new CacheFactory();
        $cache = $cacheFactory->getService();

        // Create hash key with validate characters
        $cacheFileName = md5($id);

        // Check if product is in cache
        if (! $cache->has($cacheFileName)) {

            $product = $this->getProduct($id);
           
            // Save product to cache
            $cache->set($cacheFileName, $product);

        } else {
            // TODO: remove in prod
            // Source product data, only for test purpose
            echo('Load product from cache ' . $cache::class) . '<br />';

            $product = $cache->get($cacheFileName);
        }

        return $product;
    }

}