<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(StoreLoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            return ['token' => $request->user()->createToken('auth_token')->plainTextToken];
        } else {
            return response()->json(['errors' => ['general' => 'E-Mail oder Passwort falsch.']], 422);
        }
    }

    public function checkAuth(Request $request)
    {
        return UserResource::make($request->user());
    }
}
