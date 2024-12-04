<?php

namespace App\Http\Controllers;

class CsrfTokenController extends Controller
{
    public function show (\Illuminate\Http\Request $request)
    {
        $csrf_token = csrf_token();

        return response()->json(['csrf_token' => $csrf_token,]);
    }
}
