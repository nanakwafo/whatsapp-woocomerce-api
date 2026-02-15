<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;




class PaymentController extends Controller
{
    //

    public function initialize(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $reference = Str::uuid();

        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->post(env('PAYSTACK_PAYMENT_URL').'/transaction/initialize', [
                'email' => $request->email,
                'amount' => env('LICENSE_PRICE'),
                'currency' => 'GHS',
                'reference' => $reference,
                'callback_url' => route('payment.callback')
            ]);

         return redirect($response['data']['authorization_url']);
        // return $response['data']['authorization_url'];
    }
    
    public function callback(Request $request)
        {
            $reference = $request->reference;

            if (!$reference) {
                return redirect('/')->with('error', 'No reference supplied');
            }
            
        // if ($verify['data']['amount'] != env('LICENSE_PRICE')) {
        //     abort(400);
        // }
            // Optional: Verify transaction here (extra safety)
            $verify = Http::withToken(env('PAYSTACK_SECRET_KEY'))
                ->get("https://api.paystack.co/transaction/verify/{$reference}");

            if (!$verify['status']) {
                return redirect('/')->with('error', 'Payment verification failed');
            }

            return view('payment.success');
        }

}
