<?php

namespace Modules\Payments\Transformer;

use Libs\Dataplay\Models\DataplayEntity;
use Modules\Shared\Transformers\EtlModelTransformer;

class PaymentApiTransformer extends EtlModelTransformer
{
    public function dataplayEntity(): DataplayEntity
    {
        return DataplayEntity::new()
            ->key('id', 'required')
            ->data('source_type', 'required')
            ->data('source_name', 'nullable')
            ->data('source_id', 'nullable')
            ->data('reference', 'nullable')
            ->data('method', 'nullable')
            ->data('result', 'nullable')
            ->data('amount', 'nullable')
            ->data('attempts', 'nullable')
            ->data('data', 'nullable')
            ->data('created_at', 'nullable');
    }
}
