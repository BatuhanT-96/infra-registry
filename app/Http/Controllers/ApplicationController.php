<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Models\Application;
use App\Models\Server;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('q');

        $applications = Application::query()
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('applications.index', compact('applications', 'search'));
    }

    public function create(): View
    {
        return view('applications.create');
    }

    public function store(ApplicationRequest $request): RedirectResponse
    {
        Application::create($request->validated());

        return redirect()->route('applications.index')->with('status', 'Uygulama oluşturuldu.');
    }

    public function show(Application $application): View
    {
        $groupedServers = $application->servers()
            ->orderBy('name')
            ->get()
            ->groupBy('environment_type');

        return view('applications.show', [
            'application' => $application,
            'groupedServers' => $groupedServers,
            'environments' => Server::ENVIRONMENTS,
        ]);
    }

    public function edit(Application $application): View
    {
        return view('applications.edit', compact('application'));
    }

    public function update(ApplicationRequest $request, Application $application): RedirectResponse
    {
        $application->update($request->validated());

        return redirect()->route('applications.index')->with('status', 'Uygulama güncellendi.');
    }

    public function destroy(Application $application): RedirectResponse
    {
        $application->delete();

        return redirect()->route('applications.index')->with('status', 'Uygulama silindi.');
    }
}
