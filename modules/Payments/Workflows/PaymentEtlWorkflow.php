<?php

namespace Modules\Payments\Workflows;

use Illuminate\Console\Command;
use Modules\Payments\Readers\PaymentEtlReader;
use Modules\Payments\Transformer\PaymentEtlTransformer;
use Modules\Payments\Models\Payment;
use Modules\Shared\Workflows\EtlWorkflow;
use Libs\Dataplay\Writers\PdoWriterWithTransformer;

class PaymentEtlWorkflow extends EtlWorkflow
{
    public static function start(Command $context): void
    {
        EtlWorkflow::new(class_basename(__CLASS__))
            ->setTargetModel(Payment::class)
            ->setReader(PaymentEtlReader::class)
            ->setWriterWithTransformer(
                PdoWriterWithTransformer::class,
                PaymentEtlTransformer::class
            )
            ->run();
    }
}
