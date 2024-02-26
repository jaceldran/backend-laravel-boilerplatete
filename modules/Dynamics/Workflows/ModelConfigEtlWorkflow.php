<?php

namespace Modules\Dynamics\Workflows;


use App\Models\SystemModel;
use Illuminate\Console\Command;
use Libs\Dataplay\Writers\PdoWriter;
use Modules\Shared\Workflows\EtlWorkflow;
use Modules\Dynamics\Readers\ModelConfigReader;
use Modules\Dynamics\Transformers\ModelConfigTransformer;

class ModelConfigEtlWorkflow extends EtlWorkflow
{
    public static function start(Command $context): void
    {
        EtlWorkflow::new(class_basename(__CLASS__))
            ->setTargetModel(SystemModel::class)
            ->setReaderWithTransformer(ModelConfigReader::class, ModelConfigTransformer::class)
            ->setWriter(PdoWriter::class)
            ->run();
    }
}
