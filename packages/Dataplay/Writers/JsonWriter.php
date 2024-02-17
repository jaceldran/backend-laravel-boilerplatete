<?php

namespace Packages\Dataplay\Writers;

use Illuminate\Support\LazyCollection;
use Packages\Dataplay\Traits\WithFile;
use Packages\Dataplay\Contracts\WriterInterface;

class JsonWriter implements WriterInterface
{
    use WithFile;

    private mixed $data;

    public static function new(): static
    {
        return new static();
    }

    public function setData(LazyCollection $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function run(): void
    {
        file_put_contents($this->path, json_encode($this->data, JSON_PRETTY_PRINT));
    }
}
