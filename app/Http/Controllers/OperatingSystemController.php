<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperatingSystemRequest;
use App\Models\OperatingSystem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OperatingSystemController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('q');

        $operatingSystems = OperatingSystem::query()
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('operating-systems.index', compact('operatingSystems', 'search'));
    }

    public function create(): View
    {
        return view('operating-systems.create');
    }

    public function store(OperatingSystemRequest $request): RedirectResponse
    {
        OperatingSystem::create([
            'name' => $request->validated('name'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('operating-systems.index')->with('status', 'İşletim sistemi oluşturuldu.');
    }

    public function edit(OperatingSystem $operatingSystem): View
    {
        return view('operating-systems.edit', compact('operatingSystem'));
    }

    public function update(OperatingSystemRequest $request, OperatingSystem $operatingSystem): RedirectResponse
    {
        $operatingSystem->update([
            'name' => $request->validated('name'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('operating-systems.index')->with('status', 'İşletim sistemi güncellendi.');
    }

    public function destroy(OperatingSystem $operatingSystem): RedirectResponse
    {
        if ($operatingSystem->servers()->exists()) {
            $operatingSystem->update(['is_active' => false]);

            return redirect()->route('operating-systems.index')
                ->with('status', 'Sunuculara bağlı olduğu için silinmedi, pasif duruma alındı.');
        }

        $operatingSystem->delete();

        return redirect()->route('operating-systems.index')->with('status', 'İşletim sistemi silindi.');
    }
}
