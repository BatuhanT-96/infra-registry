<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\OperatingSystem;
use App\Models\Server;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $environmentCountsRaw = Server::query()
            ->selectRaw('environment_type, COUNT(*) as total')
            ->groupBy('environment_type')
            ->pluck('total', 'environment_type');

        $environmentCounts = collect(Server::ENVIRONMENTS)
            ->mapWithKeys(fn (string $environment) => [$environment => (int) ($environmentCountsRaw[$environment] ?? 0)]);

        $operatingSystemCounts = OperatingSystem::query()
            ->selectRaw('operating_systems.name, COUNT(servers.id) as total')
            ->leftJoin('servers', 'servers.operating_system_id', '=', 'operating_systems.id')
            ->groupBy('operating_systems.id', 'operating_systems.name')
            ->orderByDesc('total')
            ->orderBy('operating_systems.name')
            ->pluck('total', 'name')
            ->map(fn ($count) => (int) $count);

        return view('dashboard.index', [
            'applicationCount' => Application::count(),
            'serverCount' => Server::count(),
            'environmentCounts' => $environmentCounts,
            'operatingSystemCounts' => $operatingSystemCounts,
        ]);
    }
}
