<?php

namespace Modules\Web\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('logs/index');
    }
}
