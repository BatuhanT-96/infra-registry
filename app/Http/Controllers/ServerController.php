<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerRequest;
use App\Models\Application;
use App\Models\OperatingSystem;
use App\Models\Server;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServerController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('q', ''));
        $environment = $request->input('environment');
        $applicationId = $request->input('application_id');

        $sortableColumns = [
            'name' => 'servers.name',
            'application' => 'applications.name',
            'ip_address' => 'servers.ip_address',
            'operating_system' => 'operating_systems.name',
            'environment' => 'servers.environment_type',
        ];

        $sort = $request->input('sort', 'name');
        $direction = strtolower((string) $request->input('direction', 'asc'));

        if (! isset($sortableColumns[$sort])) {
            $sort = 'name';
        }

        if (! in_array($direction, ['asc', 'desc'], true)) {
            $direction = 'asc';
        }

        $servers = Server::query()
            ->select('servers.*')
            ->leftJoin('applications', 'applications.id', '=', 'servers.application_id')
            ->leftJoin('operating_systems', 'operating_systems.id', '=', 'servers.operating_system_id')
            ->with(['application', 'operatingSystem'])
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($searchQuery) use ($search) {
                    $searchQuery->where('servers.name', 'like', "%{$search}%")
                        ->orWhere('servers.ip_address', 'like', "%{$search}%")
                        ->orWhere('servers.notes', 'like', "%{$search}%")
                    ->orWhereHas('application', fn ($applicationQuery) => $applicationQuery->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('operatingSystem', fn ($osQuery) => $osQuery->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($applicationId, fn ($q) => $q->where('servers.application_id', $applicationId))
            ->when($environment, fn ($q) => $q->where('servers.environment_type', $environment))
            ->orderBy($sortableColumns[$sort], $direction)
            ->orderBy('servers.id')
            ->paginate(12)
            ->withQueryString();

        return view('servers.index', [
            'servers' => $servers,
            'search' => $search,
            'environment' => $environment,
            'applicationId' => $applicationId,
            'applications' => Application::query()->orderBy('name')->get(['id', 'name']),
            'environments' => Server::ENVIRONMENTS,
            'sort' => $sort,
            'direction' => $direction,
        ]);
    }

    public function create(): View
    {
        return view('servers.create', [
            'applications' => Application::orderBy('name')->get(),
            'operatingSystems' => OperatingSystem::query()->where('is_active', true)->orderBy('name')->get(),
            'environments' => Server::ENVIRONMENTS,
        ]);
    }

    public function store(ServerRequest $request): RedirectResponse
    {
        Server::create($request->validated());

        return redirect()->route('servers.index')->with('status', 'Sunucu oluşturuldu.');
    }

    public function edit(Server $server): View
    {
        $operatingSystems = OperatingSystem::query()
            ->where('is_active', true)
            ->orWhere('id', $server->operating_system_id)
            ->orderBy('name')
            ->get();

        return view('servers.edit', [
            'server' => $server->load(['application', 'operatingSystem']),
            'applications' => Application::orderBy('name')->get(),
            'operatingSystems' => $operatingSystems,
            'environments' => Server::ENVIRONMENTS,
        ]);
    }

    public function update(ServerRequest $request, Server $server): RedirectResponse
    {
        $server->update($request->validated());

        return redirect()->route('servers.index')->with('status', 'Sunucu güncellendi.');
    }

    public function destroy(Server $server): RedirectResponse
    {
        $server->delete();

        return redirect()->route('servers.index')->with('status', 'Sunucu silindi.');
    }
}
