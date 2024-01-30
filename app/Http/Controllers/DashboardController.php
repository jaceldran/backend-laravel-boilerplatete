<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function __invoke()
    {
        $data = [
            'user' => Auth::user(),
        ];

        return Inertia::render('admin/dashboard', $data);
    }
}
