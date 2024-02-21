<?php

namespace Modules\Enrolments\Models;

use Libs\Dataplay\Models\AppEloquentModel;
use Libs\Dataplay\Traits\Newable;

class Enrolment extends AppEloquentModel //implements WithDataplayEntity
{
    use Newable;

    protected $connection = 'service';
    protected $table = 'enrolment_form';

    protected $casts = [
        'data' => 'json',
        'sync_log' => 'json',
    ];
}
