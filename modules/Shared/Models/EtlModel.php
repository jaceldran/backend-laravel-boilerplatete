<?php

namespace Modules\Shared\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\LazyCollection;
use Libs\Dataplay\Contracts\WithUpsertInterface;

class EtlModel extends Model implements WithUpsertInterface
{
    public const KEYS_HASH = 'keys_hash';
    public const DATA_HASH = 'data_hash';
    public const TAGS = 'tags';
    public const IS_ACTIVE = 'is_active';
    public const HAS_CHANGES = 'has_changes';
    public const HAS_ERRORS = 'has_errors';
    public const COUNT = 'count';
    public const DATA = 'data';

    protected $connection = 'etl';
    protected LazyCollection $data;

    protected $casts = [
        self::KEYS_HASH => 'string',
        self::DATA_HASH => 'string',
        self::TAGS => 'string',
        self::IS_ACTIVE => 'boolean',
        self::HAS_CHANGES => 'boolean',
        self::HAS_ERRORS => 'boolean',
        self::COUNT => 'integer',
        self::DATA => 'json',
    ];

    public static function new(?string $table = null): static
    {
        $new = new static();
        $new->setTable($table);
        return $new;
    }

    public function reset(?string $where = 'false'): static
    {
        $this->newQuery()
            ->whereRaw($where)
            ->update([
                self::IS_ACTIVE => false,
                self::HAS_ERRORS => false,
                self::HAS_CHANGES => false,
                self::COUNT => 0,
                self::UPDATED_AT => date('Y-m-d H:i:s')
            ]);

        return $this;
    }

    public function upsertUniqueColumns(): array
    {
        return [
            self::KEYS_HASH,
        ];
    }

    public function upsertUpdateColumns(): array
    {
        // TODO: adaptar según grammar activa: mysql, pgsql...
        $dataHash = self::DATA_HASH;
        // $hasChanges = "IF(has_changes = true, true, $dataHash <> values($dataHash))";
        $hasChanges = "$dataHash <> values($dataHash)";

        return [
            self::HAS_CHANGES => DB::raw($hasChanges),
            self::DATA_HASH,
            self::IS_ACTIVE => true,
            self::HAS_ERRORS,
            self::COUNT => DB::raw(self::COUNT . ' + 1'),
            self::DATA,
            self::TAGS,
            self::UPDATED_AT => date('Y-m-d H:i:s'),
        ];
    }
}
