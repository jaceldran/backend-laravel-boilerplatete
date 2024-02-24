<?php

namespace Modules\Enrolments\Models;

use Libs\Dataplay\Contracts\WithUpsertInterface;
use Libs\Dataplay\Models\AppEloquentModel;
use Libs\Dataplay\Traits\Newable;

class Enrolment extends AppEloquentModel implements WithUpsertInterface
{
    use Newable;

    protected $connection = 'service';
    protected $table = 'enrolment_form';

    protected $casts = [
        'data' => 'json',
        'sync_log' => 'json',
    ];

    public function upsertUniqueColumns(): array
    {
        return [
            'contact_email',
            'product_id',
        ];
    }

    public function upsertUpdateColumns(): array
    {
        return [
            'lead_id',
            'contact_id',
            'opportunity_id',
            'token',
            'data',
            'requests',
            'sync',
            'sync_attempts',
            'sync_log',
            'sync_at',
            self::UPDATED_AT => date('Y-m-d H:i:s'),
        ];
    }
}
