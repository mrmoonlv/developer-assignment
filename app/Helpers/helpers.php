<?php

declare(strict_types=1);

if (!function_exists('currency_format')) {
    function currency_format(?float $value, int $precision = 2): ?string
    {
        if ($value !== null) {
            return number_format($value, $precision, '.', ',');
        }

        return $value;
    }
}
