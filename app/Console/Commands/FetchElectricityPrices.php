<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\ElectricityPriceSeviceInterface;
use Illuminate\Console\Command;

class FetchElectricityPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-electricity-prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get electricity prices';
    public function __construct(private ElectricityPriceSeviceInterface $electricityPriceService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Start');
        $data = $this->electricityPriceService->getElectricityPrice(now()->format('Y-m-d'));
        $this->electricityPriceService->save($data);
        $this->info('Electricity prices fetched successfully.');
    }
}
