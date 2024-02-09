<?php

namespace App\Models;

use App\Models\AppEloquentBuilder;
use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppEloquentModel extends Model
{
    use HasFactory, GenerateUuid;

    public function newEloquentBuilder($query): AppEloquentBuilder
    {
        return new AppEloquentBuilder($query);
    }
}
