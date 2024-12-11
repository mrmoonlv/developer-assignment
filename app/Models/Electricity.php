<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Electricity extends Model
{
    protected function casts(): array
    {
        return [
            'delivery_start' => 'datetime:Y-m-d',
            'delivery_end'   => 'datetime:Y-m-d',
            'created_at'     => 'datetime:Y-m-d',
            'updated_at'     => 'datetime:Y-m-d',
        ];
    }
}
