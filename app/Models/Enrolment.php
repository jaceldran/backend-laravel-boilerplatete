<?php

namespace App\Models;

use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrolment extends Model
{
    use HasFactory, GenerateUuid;

    protected $casts = [
        'data' => 'json',
    ];
}
