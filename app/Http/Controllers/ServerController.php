<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerRequest;
use App\Models\Application;
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
            ->with('application')
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%"))
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
        return view('servers.edit', [
            'server' => $server,
            'applications' => Application::orderBy('name')->get(),
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
