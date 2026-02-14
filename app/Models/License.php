<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Services\LicenseKeyService;
class License extends Model
{
    protected $fillable = [
        'email',
        'key',
        'reference',
        'status',
        'expires_at',
        'activated_domains',
        'meta',
    ];

   
    protected $casts = [
    'activated_domains' => 'array',
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
        if ($this->activated_domains && $domain) {
            // if domain bound, check contains or equals (adjust to your policy)
            return stripos($domain, $this->domain) !== false;
        }
        return true;
    }
    public function revoke()
    {
        $this->update(['status' => 'revoked']);
    }

    public function restore()
    {
        $this->update(['status' => 'active']);
    }

    public function regenerate()
    {
        $this->update(['key' => LicenseKeyService::generate()]);
    }

    public function markExpired()
    {
        $this->update(['status' => 'expired']);
    }

    public function isActive()
    {
        return $this->status === 'active';
    }
}
