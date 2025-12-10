<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $fillable = [
        'key',
        'status',
        'expires_at',
        'domain',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
        'expires_at' => 'datetime',
    ];

    public function isValidForDomain(?string $domain): bool
    {
        if ($this->status !== 'active') {
            return false;
        }
        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }
        if ($this->domain && $domain) {
            // if domain bound, check contains or equals (adjust to your policy)
            return stripos($domain, $this->domain) !== false;
        }
        return true;
    }
}
