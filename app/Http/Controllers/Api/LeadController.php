<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;


class LeadController extends Controller
{
    public function store(Request $request)
    {
     
       $validated = $request->validate([
            'email'           => 'required|email',
            'store_url'       => 'nullable|string',
            'allow_marketing' => 'nullable|boolean',
        ]);


         
        Lead::create([
            'email'           => $validated['email'],
            'store_url'       => $validated['store_url'] ?? null,
            'allow_marketing' => $validated['allow_marketing'] ?? false,
        ]);
       
   
        return response()->json([
            'message' => 'Lead saved.',
            'download_url' => 'https://api.waorders.com/download-plugin'
        ]);
    }
}
