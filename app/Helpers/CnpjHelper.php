<?php

namespace App\Helpers;

class CnpjHelper
{
    /**
     * Sanitize the CNPJ by removing any non-numeric characters.
     *
     * @param string $cnpj
     * @return string
     */
    public static function sanitize(string $cnpj): string
    {
        return preg_replace('/\D/', '', $cnpj);
    }
}
