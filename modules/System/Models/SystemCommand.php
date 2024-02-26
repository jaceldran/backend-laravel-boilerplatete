<?php

namespace Modules\System\Models;

use Libs\Dataplay\Traits\Newable;
use Libs\Dataplay\Models\AppEloquentModel;
use Libs\Dataplay\Contracts\WithUpsertInterface;

class SystemCommand extends AppEloquentModel implements WithUpsertInterface
{
    use Newable;

    protected $table = 'system_commands';

    protected $casts = [
        'data' => 'json',
    ];

    public function upsertUniqueColumns(): array
    {
        return [
            'name',
        ];
    }

    public function upsertUpdateColumns(): array
    {
        return [
            'data',
            self::UPDATED_AT => date('Y-m-d H:i:s'),
        ];
    }
}
