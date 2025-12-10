<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\Request;
use App\Services\LicenseKeyService;
use Carbon\Carbon;

class LicenseAdminController extends Controller
{
    /**
     * GET /api/admin/licenses
     * List all licenses with optional filters.
     */
    public function index(Request $request)
    {
        $query = License::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('domain')) {
            $query->where('domain', 'LIKE', '%' . $request->domain . '%');
        }

        return response()->json(
            $query->orderBy('id', 'desc')->paginate(20)
        );
    }

    /**
     * POST /api/admin/licenses
     * Issue a new license key.
     */
    public function store(Request $request)
    {
        $request->validate([
            'domain' => 'nullable|string',
            'days_valid' => 'nullable|integer|min:1',
        ]);

        $expires = $request->days_valid
            ? Carbon::now()->addDays($request->days_valid)
            : null;

        $license = License::create([
            'key' => LicenseKeyService::generate(),
            'status' => 'active',
            'domain' => $request->domain,
            'expires_at' => $expires,
        ]);

        return response()->json([
            'message' => 'License issued successfully.',
            'license' => $license,
        ]);
    }

    /**
     * GET /api/admin/licenses/{license}
     * View license details.
     */
    public function show(License $license)
    {
        return response()->json($license);
    }

    /**
     * PUT /api/admin/licenses/{license}
     * Update domain/status/expiration.
     */
    public function update(Request $request, License $license)
    {
        $request->validate([
            'domain' => 'nullable|string',
            'status' => 'nullable|string|in:active,revoked,expired',
            'expires_at' => 'nullable|date',
        ]);

        $license->update($request->only(['domain', 'status', 'expires_at']));

        return response()->json([
            'message' => 'License updated successfully.',
            'license' => $license,
        ]);
    }

    /**
     * POST /api/admin/licenses/{license}/regenerate
     * Generate a brand new license key.
     */
    public function regenerate(License $license)
    {
        $license->update([
            'key' => LicenseKeyService::generate(),
        ]);

        return response()->json([
            'message' => 'License key regenerated.',
            'license' => $license,
        ]);
    }

    /**
     * POST /api/admin/licenses/{license}/revoke
     */
    public function revoke(License $license)
    {
        $license->update([
            'status' => 'revoked',
        ]);

        return response()->json([
            'message' => 'License revoked.',
            'license' => $license,
        ]);
    }

    /**
     * POST /api/admin/licenses/{license}/restore
     */
    public function restore(License $license)
    {
        $license->update([
            'status' => 'active',
        ]);

        return response()->json([
            'message' => 'License reactivated.',
            'license' => $license,
        ]);
    }
}
