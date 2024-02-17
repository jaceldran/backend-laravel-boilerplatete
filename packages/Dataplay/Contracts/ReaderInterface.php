<?php

namespace Packages\Dataplay\Contracts;

use Illuminate\Support\LazyCollection;

interface ReaderInterface
{
    public function run(): LazyCollection;
}
