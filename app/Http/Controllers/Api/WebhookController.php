<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\License;
use Illuminate\Http\Request;
use App\Services\LicenseKeyService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\LicenseMail;

class WebhookController extends Controller
{
    //
    public function handle(Request $request)
    {
        // $signature = $request->header('x-paystack-signature');

        // if ($signature !== hash_hmac('sha512', $request->getContent(), env('PAYSTACK_SECRET_KEY'))) {
        //     abort(403);
        // }

        $event = $request->input('event');

        if ($event == 'charge.success') {

            $data = $request->input('data');


            if ($data['status'] == 'success') {
                 
                $email = $data['customer']['email'];
              
                $reference = $data['reference'];

                // Prevent duplicate licenses
                if (License::where('reference', $reference)->exists()) {
                    return response()->json(['status' => 'already processed']);
                }

                $licenseKey = LicenseKeyService::generate();

                License::create([
                    'email' => $email,
                    'status' => 'active',
                    'reference' => $reference,
                    'key' => $licenseKey,
                    'expires_at' => now()->addYear()
                ]);

                // Send email
                Mail::to($email)->send(new LicenseMail($licenseKey));
            }
        }

        return response()->json(['status' => 'success']);
    }

}
