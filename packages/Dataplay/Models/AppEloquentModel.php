<?php

namespace Packages\Dataplay\Models;

use Illuminate\Database\Eloquent\Model;
use Packages\Dataplay\Traits\GenerateUuid;
use Packages\Dataplay\Models\AppEloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppEloquentModel extends Model
{
    use HasFactory, GenerateUuid;

    public function newEloquentBuilder($query): AppEloquentBuilder
    {
        return new AppEloquentBuilder($query);
    }
}
