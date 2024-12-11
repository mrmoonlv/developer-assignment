<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Electricity;
use Illuminate\Support\Collection;

class ElectricityRepository
{
    public function getAll(): Collection
    {
        return Electricity::all();
    }

    public function getByHour(\DateTime $value = null): Collection
    {
        $electricities = Electricity::where('delivery_start', '<=', $value)
            ->where('delivery_end', '>=', $value)
            ->get();

        return $electricities;
    }
}
