<?php

namespace Modules\Dynamics\Workflows;

use Illuminate\Console\Command;
use Modules\Shared\Models\EtlModel;
use Modules\Dynamics\Readers\YearReader;
use Libs\Dataplay\Writers\PdoWriterWithTransformer;
use Modules\Dynamics\Transformers\EtlYearTransformer;

class EtlYearWorkflow extends EtlWorkflow
{
    public static function start(Command $context): void
    {
        $tags = ['scope:b'];

        EtlWorkflow::new(class_basename(__CLASS__))
            ->before('reset', function (EtlWorkflow $wf) {
                $wf->targetModel->reset("true");
            })
            ->set('context', $context)
            ->setTargetModel(EtlModel::new('dynamics_years'))
            ->setReader(YearReader::new())
            ->setWriter(
                PdoWriterWithTransformer::new(),
                EtlYearTransformer::new()->setTags($tags)
            )
            ->run();
    }

}
