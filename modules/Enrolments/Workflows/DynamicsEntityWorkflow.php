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
    /**
     * Obtiene las entidades dynamics relacionadas con los enrolments
     * y las guarda en service.dynamics_entity.
     */
    public static function start(Command $context): void
    {
        EtlWorkflow::new(class_basename(__CLASS__))
            ->setTargetModel(DynamicsEntity::class)
            ->setReader(DynamicsEntityReader::class)
            ->setWriterWithTransformer(
                PdoWriterWithTransformer::class,
                DynamicsEntityTransformer::class
            )->run();
    }
}
