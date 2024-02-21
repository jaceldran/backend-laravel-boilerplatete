<?php

namespace Modules\Diplomas\Controllers;

use Inertia\Inertia;
use Modules\Shared\Controllers\Controller;

class DiplomaController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('diplomas/index');
    }
}
