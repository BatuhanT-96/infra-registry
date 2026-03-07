<?php

namespace App\Http\Requests;

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
        return [
            'application_id' => ['required', 'exists:applications,id'],
            'name' => ['required', 'string', 'max:255'],
            'ip_address' => ['required', 'ip'],
            'operating_system' => ['required', 'string', 'max:255'],
            'environment_type' => ['required', Rule::in(Server::ENVIRONMENTS)],
            'notes' => ['nullable', 'string'],
        ];
    }
}
