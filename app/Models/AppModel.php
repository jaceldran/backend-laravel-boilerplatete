<?php

namespace App\Models;

use App\Builders\AppBuilder;
use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppModel extends Model
{
    use HasFactory, GenerateUuid;

    public function newEloquentBuilder($query): AppBuilder
    {
        return new AppBuilder($query);
    }
}
