<?php

namespace Modules\Enae\Models;

use Libs\Dataplay\Models\AppEloquentModel;

class Payment extends AppEloquentModel
{
    protected $connection = 'service';
    protected $table = 'payment';

    protected $casts = [
        'data' => 'json',
    ];
}
