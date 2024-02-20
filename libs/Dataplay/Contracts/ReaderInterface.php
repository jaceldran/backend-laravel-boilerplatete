<?php

namespace Libs\Dataplay\Contracts;

use Illuminate\Support\LazyCollection;

interface ReaderInterface
{
    public function data(): LazyCollection;
}
