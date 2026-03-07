<?php

namespace App\Http\Requests;

use App\Models\OperatingSystem;
use App\Models\Server;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $currentServer = $this->route('server');
        $currentOperatingSystemId = $currentServer?->operating_system_id;

        return [
            'application_id' => ['required', 'exists:applications,id'],
            'name' => ['required', 'string', 'max:255'],
            'ip_address' => ['required', 'ip'],
            'operating_system_id' => [
                'required',
                Rule::exists('operating_systems', 'id'),
                function (string $attribute, mixed $value, \Closure $fail) use ($currentOperatingSystemId) {
                    if ($currentOperatingSystemId && (int) $value === (int) $currentOperatingSystemId) {
                        return;
                    }

                    $exists = OperatingSystem::query()->whereKey($value)->where('is_active', true)->exists();

                    if (! $exists) {
                        $fail('Seçilen işletim sistemi aktif değil.');
                    }
                },
            ],
            'environment_type' => ['required', Rule::in(Server::ENVIRONMENTS)],
            'notes' => ['nullable', 'string'],
        ];
    }
}
