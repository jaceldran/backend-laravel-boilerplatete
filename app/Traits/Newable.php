<?php

namespace App\Contracts;

use ReflectionClass;

trait Newable
{
    public static function new(): static
    {
        $static = new ReflectionClass(static::class);

        return $static->newInstanceArgs(func_get_args());
    }
}
