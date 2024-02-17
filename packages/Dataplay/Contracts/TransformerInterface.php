<?php

namespace Packages\Dataplay\Contracts;

interface TransformerInterface
{
    public function handle(array|object $rowValues): array|object;
}
