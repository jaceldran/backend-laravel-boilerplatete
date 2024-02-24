<?php

namespace Modules\Enrolments\Transformer;

use Libs\Dataplay\Contracts\TransformerInterface;
use Libs\Dataplay\Traits\Newable;

class EnrolmentEtlTransformer implements TransformerInterface
{
    use Newable;

    public function handle(array|object $rowValues): array|object
    {
        $values = $rowValues->data;
        $values['data'] = json_encode($values['data']);
        $values['sync_log'] = json_encode($values['sync_log']);
        return $values;
    }
}
