<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\ElectricityRepository;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private ElectricityRepository $electricityRepository,
    ) {
    }

    public function index(): View
    {
        $data = $this->electricityRepository->getAll();

        return view('pages.dashboard.index', [
            'data' => $data,
        ]);
    }
}
