<?php

namespace Packages\Dataplay\Contracts;

interface WithUpsertInterface
{
    public function upsertUniqueColumns(): array;

    public function upsertUpdateColumns(): array;
}
