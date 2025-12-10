<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\License;
use Carbon\Carbon;

class LicenseSeeder extends Seeder
{
    public function run()
    {
        License::create([
            'key' => 'TEST-LICENSE-0001',
            'status' => 'active',
            'expires_at' => Carbon::now()->addYear(),
            'domain' => null, // or 'example.com' if you bind
            'meta' => ['note' => 'Seeded test license'],
        ]);
    }
}
