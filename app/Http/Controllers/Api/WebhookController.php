<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\License;
use Illuminate\Http\Request;
use App\Services\LicenseKeyService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\LicenseMail;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;    

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

$data['status']='success';
            if ($data['status'] == 'success') {
                 $data['customer']['email']='nanamensah1140@gmail.com';
                $email = $data['customer']['email'];
              $data['reference']='wsdsddk123dmw'   ; 
                $reference = $data['reference'];

                // Prevent duplicate licenses
                if (License::where('reference', $reference)->exists()) {
                    return response()->json(['status' => 'already processed']);
                }

                $licenseKey = LicenseKeyService::generate();
                $user = User::firstOrCreate(
                    ['email' => $email],
                    [
                        'name' => explode('@', $email)[0],
                        'password' => Hash::make(Str::random(12))
                    ]
                );
                License::create([
                    'user_id' => $user->id,
                    'email' => $email,
                    'status' => 'active',
                    'reference' => $reference,
                    'key' => $licenseKey,
                    'expires_at' => now()->addYear()
                ]);
                // Send password setup link
                Password::sendResetLink([
                    'email' => $user->email
                ]);
                // Send email
                Mail::to($email)->send(new LicenseMail($licenseKey));
            }
        }

        return response()->json(['status' => 'success']);
    }

}
