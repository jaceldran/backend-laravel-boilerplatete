<?php

namespace Libs\Dataplay\Readers;

use Illuminate\Support\LazyCollection;
use Libs\Dataplay\Traits\Newable;
use Libs\Dataplay\Traits\WithFile;
use Libs\Dataplay\Contracts\ReaderInterface;

class JsonReader implements ReaderInterface
{
    use Newable;
    use WithFile;

    public function data(): LazyCollection
    {
        $data = file_get_contents($this->path);

        return collect(json_decode($data))->lazy();
    }
}
