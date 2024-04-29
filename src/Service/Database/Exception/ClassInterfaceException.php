<?php

namespace App\Service\Database\Exception;
use Exception;

class ClassInterfaceException extends Exception
{
    protected $message = "Class is not implement DatabaseServiceInterface so it cant be used.";
}
