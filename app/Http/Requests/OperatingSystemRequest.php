<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OperatingSystemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $operatingSystemId = $this->route('operating_system')?->id;

        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('operating_systems', 'name')->ignore($operatingSystemId)],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
