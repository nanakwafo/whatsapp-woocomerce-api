<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}

