<?php

namespace Libs\Dataplay\Contracts;

interface EntityInterface
{
    public function key(string $name, string $rules = 'required', mixed $value = null, ): static;

    public function data(string $name, string $rules = 'nullable', mixed $value = null): static;

    public function hashes(): array;

    public function hashAttributes(array $attributes): string;

    public function setValues(array $values): static;

    public function values(): array;

    public function attributes(): array;

    public function validate(): bool;

}
