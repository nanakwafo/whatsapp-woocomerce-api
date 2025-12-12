<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//    return view('welcome');
    $path = public_path('whatsapp-shop-ai.zip');
    return response()->download($path);
});

Route::get('/download-plugin', function () {
    $path = public_path('whatsapp-shop-ai.zip');

    if (!file_exists($path)) {
        return "FILE NOT FOUND AT: " . $path;
    }

    return response()->download($path);
});
