<?php

namespace Modules\Auth\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Shared\Requests\LoginRequest;
use Modules\Shared\Controllers\Controller;

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
            return Inertia::location('/');
        }

        return redirect()->route('login')->with('warning', 'Las credenciales proporcionadas no son válidas');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login'); //->with('success', 'Sesión finalizada ');
    }
}
