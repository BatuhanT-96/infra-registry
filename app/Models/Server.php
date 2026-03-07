<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Server extends Model
{
    use HasFactory;

    public const ENVIRONMENTS = ['Test', 'Pre-Prod', 'Prod'];

    protected $fillable = [
        'application_id',
        'name',
        'ip_address',
        'operating_system',
        'environment_type',
        'notes',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}
