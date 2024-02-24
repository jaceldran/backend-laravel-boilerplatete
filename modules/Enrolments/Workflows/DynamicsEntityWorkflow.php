<?php

namespace Modules\Enrolments\Workflows;

use Illuminate\Console\Command;
use Modules\Shared\Workflows\EtlWorkflow;
use Modules\Enrolments\Models\DynamicsEntity;
use Libs\Dataplay\Writers\PdoWriterWithTransformer;
use Modules\Enrolments\Readers\DynamicsEntityReader;
use Modules\Enrolments\Transformer\DynamicsEntityTransformer;

class DynamicsEntityWorkflow extends EtlWorkflow
{
    public static function start(Command $context): void
    {
        EtlWorkflow::new(class_basename(__CLASS__))
            ->setTargetModel(DynamicsEntity::new())
            ->setReader(DynamicsEntityReader::new())
            ->setWriter(
                PdoWriterWithTransformer::new(),
                DynamicsEntityTransformer::new()
            )
            ->run();
    }
}
