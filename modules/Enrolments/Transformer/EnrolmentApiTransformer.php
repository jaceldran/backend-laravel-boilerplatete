<?php

namespace Modules\Enrolments\Transformer;

use Libs\Dataplay\Models\DataplayEntity;
use Modules\Shared\Transformers\EtlModelTransformer;

class EnrolmentApiTransformer extends EtlModelTransformer
{
    public function dataplayEntity(): DataplayEntity
    {
        return DataplayEntity::new()
            ->key('id', 'required')
            ->data('contact_email', 'required')
            ->data('lead_id', 'nullable')
            ->data('product_id', 'nullable')
            ->data('contact_id', 'nullable')
            ->data('opportunity_id', 'nullable')
            ->data('token', 'nullable')
            ->data('data', 'nullable')
            ->data('requests', 'nullable')
            ->data('sync', 'nullable')
            ->data('sync_attempts', 'nullable')
            ->data('sync_log', 'nullable')
            ->data('sync_at', 'nullable')
            ->data('created_at', 'nullable');
    }
}
