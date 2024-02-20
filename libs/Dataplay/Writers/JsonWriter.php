<?php

namespace Libs\Dataplay\Writers;

use Illuminate\Support\LazyCollection;
use Libs\Dataplay\Traits\WithFile;
use Libs\Dataplay\Contracts\WriterInterface;

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

    public function writeData(): void
    {
        file_put_contents($this->path, json_encode($this->data, JSON_PRETTY_PRINT));
    }
}
