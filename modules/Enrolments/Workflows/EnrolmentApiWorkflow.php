<?php

namespace Modules\Enrolments\Workflows;

use Illuminate\Console\Command;
use Modules\Shared\Models\EtlModel;
use Modules\Shared\Workflows\EtlWorkflow;
use Modules\Enrolments\Readers\EnrolmentApiReader;
use Libs\Dataplay\Writers\PdoWriterWithTransformer;
use Modules\Enrolments\Transformer\EnrolmentApiTransformer;

class EnrolmentApiWorkflow extends EtlWorkflow
{
    public static function start(Command $context): void
    {
        $tags = [];

        EtlWorkflow::new(class_basename(__CLASS__))
            ->setTargetModel(EtlModel::new('enrolments'))
            ->setReader(EnrolmentApiReader::new())
            ->setReader(EnrolmentApiReader::new())
            ->setWriter(
                PdoWriterWithTransformer::new(),
                EnrolmentApiTransformer::new()->setTags($tags)
            )
            ->run();
    }

}
