<?php

namespace App\Service\Database\Driver;

interface IElasticSearchDriver
{
    /**
    * @param string $id
    * @return array
    */
    public function findById(string $id);
}