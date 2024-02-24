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
    public static function start(Command $context): void
    {
        EtlWorkflow::new(class_basename(__CLASS__))
            ->setTargetModel(Enrolment::new())
            ->setReader(EnrolmentEtlReader::new())
            ->setWriter(
                PdoWriterWithTransformer::new(),
                EnrolmentEtlTransformer::new()
            )
            ->run();
    }

}
