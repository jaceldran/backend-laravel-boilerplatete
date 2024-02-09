<?php

namespace App\Models;

class Enrolment extends AppEloquentModel
{
    protected $connection = 'service';
    protected $table = 'enrolment_form';

    protected $casts = [
        'data' => 'json',
    ];
}
