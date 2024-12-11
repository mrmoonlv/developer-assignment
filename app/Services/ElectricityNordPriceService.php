<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Electricity;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ElectricityNordPriceService implements ElectricityPriceSeviceInterface
{
    private const URL = 'https://dataportal-api.nordpoolgroup.com/api/';


    public function getElectricityPrice(string $date, string $area = 'LV', string $currency = 'EUR'): array
    {
        $data = [];

        try {
            $client = new Client(['base_uri' => self::URL]);
            $response = $client->request('GET', 'DayAheadPrices', [
                'query' => [
                    'date'         => $date,
                    'deliveryArea' => $area,
                    'currency'     => $currency,
                ],
            ]);

            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        return $data;
    }

    public function save(array $data): void
    {
        $area = $data['deliveryAreas'][0];
        $currency = $data['currency'];

        // We can do bulk/mass assignment insert if we don't need model events
        foreach ($data['multiAreaEntries'] as $value) {
            $electricity = new Electricity();
            $electricity->area = $area;
            $electricity->currency = $currency;
            $electricity->price = $value['entryPerArea'][$area] ?? null;
            $electricity->delivery_start = Carbon::parse($value['deliveryStart']);
            $electricity->delivery_end = Carbon::parse($value['deliveryEnd']);
            $electricity->save();
        }
    }
}
