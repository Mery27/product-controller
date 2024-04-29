<?php

declare(strict_types=1);

namespace App\Service\Product;

use Psr\SimpleCache\CacheInterface;
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

        return $repository->getProductById($id);
    }

    /**
     * Finding a product using a cache service
     * 
     * @param string $id Product ID
     * @param CacheInterface $cache Cache service for saving the prodcut wich is once loaded
     * @return array
     */
    public function getProductWithCache(string $id, CacheInterface $cache): array
    {        
        // Create hash key with validate characters
        $cacheFileName = md5($id);
        
        // Check if product is in cache
        if (! $cache->has($cacheFileName)) {
            // Load product from DB
            echo 'Load product from Database <br />';
            $product = $this->getProduct($id);
            // Save product to cache
            $cache->set($cacheFileName, $product);
        
        } else {
            // Load product from cache
            echo 'Load product from cache ' . $cache::class  . '<br />';
            $product = $cache->get($cacheFileName);
        }

        return $product;
    }

}