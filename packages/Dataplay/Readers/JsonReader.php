<?php

namespace Packages\Dataplay\Readers;

use Illuminate\Support\LazyCollection;
use Packages\Dataplay\Traits\WithFile;
use Packages\Dataplay\Contracts\ReaderInterface;

class JsonReader implements ReaderInterface
{
    use WithFile;

    public static function new(): static
    {
        return new static();
    }

    public function run(): LazyCollection
    {
        $data = file_get_contents($this->path);

        return collect(json_decode($data))->lazy();
    }
}
