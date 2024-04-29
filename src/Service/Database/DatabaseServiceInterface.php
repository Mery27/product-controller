<?php

declare(strict_types=1);

namespace App\Service\Database;

interface DatabaseServiceInterface
{
    /**
    * @param string $id
    * @return array
    */
    public function getProductById(string $id): array;
}
