<?php

namespace App\Service\Database\Exception;

use App\Config\AppConfiguration;
use Exception;

class FileNotFoundException extends Exception
{
    // protected $message = 'File with database service name '. AppConfiguration::DATABASE_SERVICE .' class dont exists.';
}
