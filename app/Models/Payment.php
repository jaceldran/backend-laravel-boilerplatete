<?php

namespace App\Models;

class Payment extends AppModel
{
    protected $connection = 'service';
    protected $table = 'payment';

    protected $casts = [
        'data' => 'json',
    ];
}
