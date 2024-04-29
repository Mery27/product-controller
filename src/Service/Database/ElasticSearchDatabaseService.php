<?php

declare(strict_types=1);

namespace App\Service\Database;

use App\Service\Database\DatabaseServiceInterface;
use App\Service\Database\Driver\IElasticSearchDriver;

class ElasticSearchDatabaseService implements DatabaseServiceInterface, IElasticSearchDriver
{
    /**
     * Find product from ID
     * 
    * @param string $id
    * @return array
    */
    public function findById(string $id): array
    {
        return [
            'id'    => $id,
            'name'  => "Product {$id} from ElasticSearch"
        ];
    }

    public function getProductById(string $id): array {
        
        return $this->findById($id);
    }
}
