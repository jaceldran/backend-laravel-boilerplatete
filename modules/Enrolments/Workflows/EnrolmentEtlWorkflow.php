<?php

namespace Modules\Enrolments\Workflows;

use Illuminate\Console\Command;
use Modules\Enrolments\Readers\EnrolmentEtlReader;
use Modules\Enrolments\Transformer\EnrolmentEtlTransformer;
use Modules\Enrolments\Models\Enrolment;
use Modules\Shared\Workflows\EtlWorkflow;
use Libs\Dataplay\Writers\PdoWriterWithTransformer;

class EnrolmentEtlWorkflow extends EtlWorkflow
{
    /**
     * Traslada de la tabla etl.enrolments a service.enrolment_form
     */
    public static function start(Command $context): void
    {
        EtlWorkflow::new(class_basename(__CLASS__))
            ->setTargetModel(Enrolment::class)
            ->setReader(EnrolmentEtlReader::class)
            ->setWriterWithTransformer(
                PdoWriterWithTransformer::class,
                EnrolmentEtlTransformer::class
            )->run();
    }

}
