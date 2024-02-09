<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;

class LogoutController
{
    public function __invoke(): void
    {
        Auth::logout();
    }
}
