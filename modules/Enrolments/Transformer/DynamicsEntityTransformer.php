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
            'entity_name' => 'contact',
            'entity_id' => $element['id'],
            'data' => json_encode($element),
            'alias' => null,
        ];
    }
}
