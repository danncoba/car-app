<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function user(Request $request)
    {
        return response()->json(['user' => Auth::user(), 'token' => csrf_token()]);
    }
}
