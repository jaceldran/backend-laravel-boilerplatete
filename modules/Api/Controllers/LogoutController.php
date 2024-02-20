<?php

namespace Modules\Api\Controllers;

use Illuminate\Support\Facades\Auth;

class LogoutController
{
    public function __invoke(): void
    {
        Auth::logout();
    }
}
