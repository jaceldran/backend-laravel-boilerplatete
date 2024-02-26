<?php

namespace Modules\Enrolments\Transformer;

use Libs\Dataplay\Contracts\TransformerInterface;
use Libs\Dataplay\Traits\Newable;

class DynamicsEntityTransformer implements TransformerInterface
{
    use Newable;

    public function handle(array|object $element): array|object
    {
        return [
            'entity_id' => $element['id'],
            'entity_name' => $element['entity_name'], // asignado en el reader
            'data' => json_encode($element),
            'alias' => null,
        ];
    }
}
