<?php

namespace App\Models;

use Packages\Dataplay\Models\AppEloquentModel;

class Payment extends AppEloquentModel
{
    protected $connection = 'service';
    protected $table = 'payment';

    protected $casts = [
        'data' => 'json',
    ];
}
