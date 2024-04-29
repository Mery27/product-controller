<?php

namespace App\Service\Validator;

class CacheKeyValidator
{

    public static function isValidKey($key, $allowedCharacters = null): bool
    {

        if ($allowedCharacters === null) {
            $allowedCharacters = 'a-zA-Z0-9_';
        }

        // Construct the regular expression pattern
        $pattern = '/^[' . preg_quote($allowedCharacters, '/') . ']+$/';

        // Check if the key matches the pattern
        $result = preg_match($pattern, $key) === 1;

        if ($result == false) {
            return false;
        }

        return true;
    }
}
