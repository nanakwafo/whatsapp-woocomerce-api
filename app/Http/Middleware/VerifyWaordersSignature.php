<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyWaordersSignature
{
   public function handle(Request $request, Closure $next)
    {
        $receivedSignature = $request->header('X-Waorders-Signature');
        $timestamp = $request->header('X-Waorders-Timestamp');

        if (!$receivedSignature || !$timestamp) {
            return response()->json([
                'message' => 'Missing authentication headers'
            ], 403);
        }

        // Ensure timestamp is numeric
        if (!is_numeric($timestamp)) {
            return response()->json([
                'message' => 'Invalid timestamp format'
            ], 403);
        }

        // 5 minute expiration window
        if (abs(time() - (int) $timestamp) > 300) {
            return response()->json([
                'message' => 'Request expired'
            ], 403);
        }

        $secret = env('WAORDERS_SECRET');

        $computedSignature = hash_hmac(
            'sha256',
            $timestamp . '.' . $request->getContent(),
            $secret
        );

        if (!hash_equals($receivedSignature, $computedSignature)) {
            return response()->json([
                'message' => 'Invalid signature'
            ], 403);
        }

        return $next($request);
    }
}
