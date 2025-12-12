<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
 
});

Route::get('/download-plugin', function () {
    $path = public_path('whatsapp-shop-ai.zip');

    if (!file_exists($path)) {
        return "FILE NOT FOUND AT: " . $path;
    }

    return response()->download($path);
});
