<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WhatsappConversation;

class MessageController extends Controller
{
    //


    public function sendMessage(Request $request)
    {
        $license_key  = $request->input('license_key');
        $store_domain =  $request->input('store_domain');
        $phoneId = env('WHATSAPP_PHONE_ID');
        $accessToken = env('WHATSAPP_ACCESS_TOKEN'); 

        $recipientPhoneNumber = $request->input('phone_number');
        $messageText = $request->input('message');      

        $url = "https://graph.facebook.com/v24.0/{$phoneId}/messages";      
        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => $recipientPhoneNumber,
            'type' => 'text',
            'text' => [
                'body' => $messageText
            ]
        ];
        
        $response = \Http::withToken($accessToken)->post($url, $payload);
       
        if ($response->successful()) {
            return response()->json(['message' => 'Message sent successfully']);
        } else {
            return response()->json(['error' => 'Failed to send message', 'details' => $response->body()], 500);
        }  
    }  
    
    public function sendMessageTemplateWithText(Request $request)
    {
        $license_key  = $request->input('license_key');
        $store_domain =  $request->input('store_domain');
        $phoneId = env('WHATSAPP_PHONE_ID');
        $accessToken = env('WHATSAPP_ACCESS_TOKEN'); 

        $recipientPhoneNumber = $request->input('phone_number');
        $textVariables = $request->input('message', []);

        $url = "https://graph.facebook.com/v24.0/{$phoneId}/messages";      
        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => $recipientPhoneNumber,
            'type' => 'template',
            'template' => [
                'name' => 'order_update_notification',
                'language' => [
                    'code' => 'en'
                ],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                             [
                                'type' => 'text', 
                                'text' => $textVariables
                             ]
                         ]
                    ]
                ]
            ]
        ];
        
        $response = \Http::withToken($accessToken)->post($url, $payload);
       
        if ($response->successful()) {
            return response()->json(['message' => 'Template message sent successfully']);
        } else {
            return response()->json(['error' => 'Failed to send template message', 'details' => $response->body()], 500);
        }  
    }



    public function send(Request $request)
    {
        $phone = $request->phone_number;
        $message = $request->message;

        $conversation = WhatsappConversation::where('phone_number', $phone)->first();

        $sessionOpen = false;

        if ($conversation && $conversation->session_expires_at) {
            $sessionOpen = now()->lt($conversation->session_expires_at);
        }

        if ($sessionOpen) {
            return $this->sendFreeText($phone, $message);
        }

        return $this->sendTemplate($phone, $message);
    }


    private function sendFreeText($phone, $message)
    {
        $phoneId = env('WHATSAPP_PHONE_ID');
        $accessToken = env('WHATSAPP_ACCESS_TOKEN'); 

        $recipientPhoneNumber = $phone;
        $messageText = $message;      

        $url = "https://graph.facebook.com/v24.0/{$phoneId}/messages";      
        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => $recipientPhoneNumber,
            'type' => 'text',
            'text' => [
                'body' => $messageText
            ]
        ];
        
        $response = \Http::withToken($accessToken)->post($url, $payload);
       
        if ($response->successful()) {
            return response()->json(['message' => 'Message sent successfully']);
        } else {
            return response()->json(['error' => 'Failed to send message', 'details' => $response->body()], 500);
        }  
    }
    private function sendTemplate($phone, $message)
    {
        
        $phoneId = env('WHATSAPP_PHONE_ID');
        $accessToken = env('WHATSAPP_ACCESS_TOKEN'); 

        $recipientPhoneNumber = $phone;
        $textVariables = $message;

        $url = "https://graph.facebook.com/v24.0/{$phoneId}/messages";      
        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => $recipientPhoneNumber,
            'type' => 'template',
            'template' => [
                'name' => 'order_update_notification',
                'language' => [
                    'code' => 'en'
                ],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                             [
                                'type' => 'text', 
                                'text' => $textVariables
                             ]
                         ]
                    ]
                ]
            ]
        ];
        
        $response = \Http::withToken($accessToken)->post($url, $payload);
       
        if ($response->successful()) {
            return response()->json(['message' => 'Template message sent successfully']);
        } else {
            return response()->json(['error' => 'Failed to send template message', 'details' => $response->body()], 500);
        }  
    }


    public function webhook(Request $request)
    {
        
       if ($request->isMethod('get')) {

    
        $params = $request->query();
     
        $mode = $params['hub_mode'] ?? null;
        $token = $params['hub_verify_token'] ?? null;
        $challenge = $params['hub_challenge'] ?? null;

        \Log::info([
            'mode' => $mode,
            'token_received' => $token,
            'expected_token' => "waorders_verify_token_224",
        ]);

        if ($mode === 'subscribe' && $token === "waorders_verify_token_224") {
            return response($challenge, 200);
        }

        return response('Verification failed', 403);
       }

    // Handle incoming messages (POST)
        if ($request->isMethod('post')) {

            $message = $request->input('entry.0.changes.0.value.messages.0');

            if (!$message) {
                return response()->json(['ok' => true]);
            }

            $from = $message['from'];

            WhatsappConversation::updateOrCreate(
                ['phone_number' => $from],
                [
                    'last_inbound_at' => now(),
                    'session_expires_at' => now()->addHours(24),
                ]
            );

            return response()->json(['ok' => true]);
        }
    }
}

