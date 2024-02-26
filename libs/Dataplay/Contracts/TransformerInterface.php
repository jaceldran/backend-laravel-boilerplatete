<?php

namespace Libs\Dataplay\Contracts;

interface TransformerInterface
{
    public function handle(array|object $value): array|object;
}
