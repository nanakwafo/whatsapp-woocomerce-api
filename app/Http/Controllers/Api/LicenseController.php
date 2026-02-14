<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\Request;
use App\Services\LicenseKeyService;
use Carbon\Carbon;
use Facade\Log;


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
        'key' => 'required|string',
        'domain' => 'required|string',
        ]);

        $license = License::where('key', $request->key)
            ->where('status', 'active')
            ->first();


        if (!$license) {
            return response()->json(['valid' => false], 403);
        }

        if ($license->expires_at->isPast()) {
            return response()->json([
                'valid' => false,
                'expired' => true
            ], 403);
        }

        $domain = $this->normalizeDomain($request->domain);

        $domains = $license->activated_domains ?? [];

        // Already activated
        if (in_array($domain, $domains)) {
            return response()->json([
                'valid' => true,
                'expires_at' => $license->expires_at->toDateString()
            ]);
        }

        // Check limit
        if (count($domains) >= $license->max_activations) {
            return response()->json([
                'valid' => false,
                'message' => 'Activation limit reached'
            ], 403);
        }



        $domains[] = $domain;

        $updateData = [
            'activated_domains' => $domains,
            'activation_count' => count($domains),
        ];
        if ($license->first_activated_ip && 
            $license->first_activated_ip !== $request->ip()) {

            // Optional: block immediately
            // return response()->json(['valid' => false, 'message' => 'Suspicious activation detected'], 403);

            // Or just log it
            \Log::warning('Possible license sharing detected', [
                'license' => $license->key,
                'first_ip' => $license->first_activated_ip,
                'current_ip' => $request->ip()
            ]);
        }
        // If first activation ever
        if (!$license->first_activated_ip) {
            $updateData['first_activated_ip'] = $request->ip();
            $updateData['first_activated_at'] = now();
        }

       $license->update($updateData);

        return response()->json([
            'valid' => true,
            'expires_at' => $license->expires_at->toDateString()
        ]);


    }

    public function deactivate(Request $request)
    {
        $request->validate([
        'key' => 'required|string',
        'domain' => 'required|string',
        ]);

        $license = License::where('key', $request->key)->first();

        if (!$license) {
            return response()->json(['valid' => false], 403);
        }

        $domain = $this->normalizeDomain($request->domain);

        $domains = $license->activated_domains ?? [];

        $domains = array_filter($domains, function ($d) use ($domain) {
            return $d !== $domain;
        });

        $license->update([
            'activated_domains' => array_values($domains),
            'activation_count' => count($domains)
        ]);

        return response()->json(['success' => true]);
    }


    private function normalizeDomain($domain)
        {
            $host = parse_url($domain, PHP_URL_HOST);

            if (!$host) {
                $host = $domain;
            }

            $host = strtolower($host);

            // Remove www.
            return preg_replace('/^www\./', '', $host);
        }
}
