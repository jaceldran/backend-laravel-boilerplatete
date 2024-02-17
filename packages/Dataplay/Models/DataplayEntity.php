<?php

namespace Packages\Dataplay;

use Illuminate\Support\Facades\Validator;
use Packages\Dataplay\Contracts\EntityInterface;
use Packages\Dataplay\Traits\Newable;

class DataplayEntity implements EntityInterface
{
    public const NAME = 'name';
    public const VALUE = 'value';
    public const RULES = 'rules';
    public const ERROR = 'error';
    public const KEYS_HASH = 'keys_hash';
    public const DATA_HASH = 'data_hash';
    public const DATA = 'data';

    private array $keysAttributes = [];
    private array $dataAttributes = [];
    private string $errorMessage;

    use Newable;

    public function key(string $name, string $rules = 'required', mixed $value = null): static
    {
        return $this->register($name, $rules, 'key', $value);
    }

    public function data(string $name, string $rules = 'nullable', mixed $value = null): static
    {
        return $this->register($name, $rules, 'data', $value);
    }

    public function register(
        string $name,
        string $rules = 'nullable',
        string $keyOrData = 'data',
        mixed $value = null
    ): static
    {

        $attributes = $keyOrData === 'key'
            ? 'keysAttributes'
            : 'dataAttributes';

        $this->{$attributes}[$name] = [
            self::NAME => $name,
            self::VALUE => $value,
            self::RULES => $rules,
        ];

        return $this;
    }

    public function hashes(): array
    {
        return [
            self::KEYS_HASH => $this->hashAttributes($this->keysAttributes),
            self::DATA_HASH => $this->hashAttributes($this->dataAttributes),
        ];
    }

    public function hashAttributes(array $attributes): string
    {
        return md5(implode('-', array_column($attributes, self::VALUE)));
    }

    public function values(): array
    {
        $keys = array_map(fn($key) => $key[self::VALUE], $this->keysAttributes);
        $data = array_map(fn($data) => $data[self::VALUE], $this->dataAttributes);

        return [...$keys, ...$data];
    }

    public function attributes(): array
    {
        return [...$this->keysAttributes, ...$this->dataAttributes];
    }

    public function validate(): bool
    {
        $rules = array_map(fn($key) => $key[self::RULES], $this->attributes());

        try {
            Validator::make($this->values(), $rules)->validate();
        } catch (\Exception $exception) {
            $this->errorMessage = $exception->getMessage();
            return false;
        }

        return true;
    }

    public function error(): ?string
    {
        return $this->errorMessage ?? null;
    }

    public function setValues(array $values): static
    {
        foreach ($values as $key => $value) {
            if (isset($this->keysAttributes[$key])) {
                $this->keysAttributes[$key][self::VALUE] = $value;
            }

            if (isset($this->dataAttributes[$key])) {
                $this->dataAttributes[$key][self::VALUE] = $value;
            }
        }

        return $this;
    }
}
