<?php

declare(strict_types=1);

namespace App\Services;

interface ElectricityPriceSeviceInterface
{
    public function getElectricityPrice(string $date, string $area, string $currency);
}
