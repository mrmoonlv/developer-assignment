<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElectricityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'area' => $this->area,
            'currency' => $this->currency,
            'price' => $this->price * config('app.electricity_price_multiplier'),
            'delivery_start' => $this->delivery_start,
            'delivery_end' => $this->delivery_end,
        ];
    }
}
