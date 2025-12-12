<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/download-plugin', function () {
    $path = public_path('whatsapp-shop-ai.zip');
    return response()->download($path);
});
