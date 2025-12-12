<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
class LeadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'store_url' => 'nullable|string',
            'allow_marketing' => 'boolean',
        ]);

        Lead::create([
            'email' => $request->email,
            'store_url' => $request->store_url,
            'allow_marketing' => $request->allow_marketing ?? false,
        ]);

        return response()->json([
            'message' => 'Lead saved.',
            'download_url' => 'https://api.waorders.com/download-plugin'
        ]);
    }
}
