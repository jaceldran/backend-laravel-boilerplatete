<?php

namespace Libs\Dataplay\Models;

use Illuminate\Database\Eloquent\Model;
use Libs\Dataplay\Traits\GenerateUuid;
use Libs\Dataplay\Models\AppEloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppEloquentModel extends Model
{
    use HasFactory, GenerateUuid;

    public function newEloquentBuilder($query): AppEloquentBuilder
    {
        return new AppEloquentBuilder($query);
    }
}
