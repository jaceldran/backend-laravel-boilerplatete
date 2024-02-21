<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakeSale extends Model
{
    use HasFactory;

    protected $connection = 'sqlite';
    protected $table = 'sales';
}
