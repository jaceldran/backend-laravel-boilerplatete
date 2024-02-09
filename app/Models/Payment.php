<?php

namespace App\Models;

class Payment extends AppEloquentModel
{
    protected $connection = 'service';
    protected $table = 'payment';

    protected $casts = [
        'data' => 'json',
    ];
}
