<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GenerateUuid
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->getKey() === null) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function incrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
