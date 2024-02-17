<?php

namespace Packages\Dataplay\Contracts;

interface ValidationRuleInterface
{
    public function validate(mixed $value): bool;
    public function getError(): string;
}
