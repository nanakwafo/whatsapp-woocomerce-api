<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    /**
     * POST /api/check-license
     * Body: { "license_key": "...", "domain": "https://example.com" }
     * Response: { valid: true|false, expires_at: "YYYY-MM-DD", message: "..." }
     */
    public function check(Request $request)
    {
        $request->validate([
            'license_key' => 'required|string',
            'domain' => 'nullable|string',
        ]);

        $licenseKey = $request->input('license_key');
        $domain = $request->input('domain');

        $license = License::where('key', $licenseKey)->first();

        if (! $license) {
            return response()->json(['valid' => false, 'message' => 'License not found.'], 200);
        }    

        if ($license->isValidForDomain($domain)) {
            return response()->json([
                'valid' => true,
                'expires_at' => $license->expires_at ? $license->expires_at->toDateString() : null,
                'message' => 'License valid.',
            ], 200);
        }

        // invalid for domain / expired / revoked
        return response()->json([
            'valid' => false,
            'expires_at' => $license->expires_at ? $license->expires_at->toDateString() : null,
            'message' => 'License invalid or expired.',
        ], 200);
    }
}
