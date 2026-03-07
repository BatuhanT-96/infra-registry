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
        $search = $request->string('q');
        $environment = $request->string('environment');

        $servers = Server::query()
            ->with(['application', 'operatingSystem'])
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%")
                    ->orWhereHas('application', fn ($applicationQuery) => $applicationQuery->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('operatingSystem', fn ($osQuery) => $osQuery->where('name', 'like', "%{$search}%"));
            })
            ->when($environment, fn ($q) => $q->where('environment_type', $environment))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('servers.index', [
            'servers' => $servers,
            'search' => $search,
            'environment' => $environment,
            'environments' => Server::ENVIRONMENTS,
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
