<?php

namespace Modules\Enrolments\Models;

use Libs\Dataplay\Contracts\WithUpsertInterface;
use Libs\Dataplay\Models\AppEloquentModel;
use Libs\Dataplay\Traits\Newable;

class DynamicsEntity extends AppEloquentModel implements WithUpsertInterface
{
    use Newable;

    protected $connection = 'service';
    protected $table = 'dynamics_entity';

    protected $casts = [
        'data' => 'json',
        'alias' => 'json',
    ];

    public function upsertUniqueColumns(): array
    {
        return [
            'entity_name',
            'entity_id',
        ];
    }

    public function upsertUpdateColumns(): array
    {
        return [
            'data',
            'alias',
            self::UPDATED_AT => date('Y-m-d H:i:s'),
        ];
    }
}
