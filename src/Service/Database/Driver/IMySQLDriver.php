<?php

namespace App\Service\Database\Driver;

interface IMySQLDriver
{
    /**
    * @param string $id
    * @return array
    */
    public function findProduct(string $id);
}