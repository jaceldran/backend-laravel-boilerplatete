<?php

namespace Libs\Dataplay\Contracts;

use Libs\Dataplay\Models\DataplayEntity;

interface WithDataplayEntity
{
    public function dataplayEntity(): DataplayEntity;
}
