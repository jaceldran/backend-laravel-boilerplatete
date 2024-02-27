<?php

namespace Modules\Payments\Workflows;

use Illuminate\Console\Command;
use Modules\Shared\Models\EtlModel;
use Modules\Shared\Workflows\EtlWorkflow;
use Modules\Payments\Readers\PaymentApiReader;
use Libs\Dataplay\Writers\PdoWriterWithTransformer;
use Modules\Payments\Transformer\PaymentApiTransformer;

class PaymentApiWorkflow extends EtlWorkflow
{
    public static function start(Command $context): void
    {
        $tags = [];

        EtlWorkflow::new(class_basename(__CLASS__))
            ->setTargetModel(EtlModel::new('payments'))
            ->setReader(PaymentApiReader::new())
            ->setWriterWithTransformer(
                PdoWriterWithTransformer::new(),
                PaymentApiTransformer::new()->setTags($tags)
            )
            ->run();
    }

}
