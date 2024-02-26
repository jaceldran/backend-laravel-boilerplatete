<?php

namespace Modules\Dynamics\Transformers;

use Illuminate\Support\Str;
use Libs\Dataplay\Traits\Newable;
use Illuminate\Support\Facades\Log;
use Libs\Dataplay\Contracts\TransformerInterface;

class ModelConfigTransformer implements TransformerInterface
{
    use Newable;

    private string $type;
    private string $name;

    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function handle(array|object $value): array|object
    {
        return [
            'id' => Str::uuid(),
            'type' => $this->type,
            'name' => $this->name,
            'created_at' => $value['created_at'] ?? now()->toDateTimeString(),
            'data' => json_encode($value ?? []),
        ];
    }
}
