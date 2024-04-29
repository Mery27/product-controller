<?php

declare(strict_types=1);

namespace App\Service\Database;

use App\Service\Database\DatabaseServiceInterface;
use App\Service\Database\Driver\IMySQLDriver;

class MySQLDatabaseService implements DatabaseServiceInterface, IMySQLDriver
{
    /**
     * Find product with from ID
     * 
    * @param string $id
    * @return array
    */
    public function findProduct(string $id): array
    {
        return [
            'id'    => $id,
            'name'  => "Product {$id} from MySQL"
        ];
    }

    public function getProductById(string $id): array {
        
        return $this->findProduct($id);
    }
}
