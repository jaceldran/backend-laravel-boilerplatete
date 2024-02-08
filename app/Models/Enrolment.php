<?php

namespace App\Models;

class Enrolment extends AppModel
{
    protected $connection = 'service';
    protected $table = 'enrolment_form';

    protected $casts = [
        'data' => 'json',
    ];
}
