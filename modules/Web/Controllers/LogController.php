<?php

namespace Modules\Web\Controllers;

use Inertia\Inertia;
use Modules\Shared\Controllers\Controller;

class LogController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('logs/index');
    }
}
