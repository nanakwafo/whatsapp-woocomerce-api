<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $licenses = auth()->user()->licenses;
        

        return view('dashboard', compact('licenses'));
    }
}
