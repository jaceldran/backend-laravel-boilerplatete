<?php

namespace Modules\Pages\Controllers;

use Inertia\Inertia;
use Modules\Shared\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('pages/home');
    }
}
