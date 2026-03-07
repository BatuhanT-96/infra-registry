<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Server;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $environmentCounts = Server::query()
            ->selectRaw('environment_type, COUNT(*) as total')
            ->groupBy('environment_type')
            ->pluck('total', 'environment_type');

        return view('dashboard.index', [
            'applicationCount' => Application::count(),
            'serverCount' => Server::count(),
            'environmentCounts' => $environmentCounts,
        ]);
    }
}
