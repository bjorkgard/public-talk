<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMSResponseController extends Controller
{
    public function __invoke(Request $request)
    {
        \Log::info(json_encode($request));
    }
}
