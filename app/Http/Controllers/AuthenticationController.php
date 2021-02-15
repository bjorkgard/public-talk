<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthenticationController extends Controller
{
    public function resetPassword(Request $request)
    {
        return Inertia::render('Auth/ResetPassword', [
            'token' => $request->query('token'),
            'email' => $request->query('email')
        ]);
    }
}
