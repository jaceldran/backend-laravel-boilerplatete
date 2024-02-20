<?php

namespace Modules\Web\Controllers;

use Inertia\Inertia;

class DiplomaController
{
    public function __invoke()
    {
        return Inertia::render('diplomas/index');
    }
}
