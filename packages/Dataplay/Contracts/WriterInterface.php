<?php

namespace Packages\Dataplay\Contracts;

use Illuminate\Support\LazyCollection;

interface WriterInterface
{
    public function setData(LazyCollection $data): static;

    public function run(): void;
}
