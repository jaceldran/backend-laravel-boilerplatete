<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function form(): Response
    {
        return Inertia::render('auth/form');
    }

    public function login(LoginRequest $request) //: Response
    {

        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('web')->attempt($credentials, true)) {
            return Inertia::location('admin/dashboard');
        }

        return redirect()->route('login')->with('warning', 'Las credenciales proporcionadas no son válidas');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('success', 'Sesión finalizada ');
    }
}
