<?php

namespace Modules\Enrolments\Workflows;

use Illuminate\Console\Command;
use Modules\Shared\Models\EtlModel;
use Modules\Shared\Workflows\EtlWorkflow;
use Modules\Enrolments\Readers\ApiEnrolmentReader;
use Libs\Dataplay\Writers\PdoWriterWithTransformer;
use Modules\Enrolments\Transformer\ApiEnrolmentTransformer;

class ApiEnrolmentWorkflow extends EtlWorkflow
{
    public static function start(Command $context): void
    {
        $tags = [];

        EtlWorkflow::new(class_basename(__CLASS__))
            ->before('reset', function (EtlWorkflow $wf) {
                $wf->targetModel->reset("true");
            })
            ->set('context', $context)
            ->setTargetModel(EtlModel::new('enrolments'))
            ->setReader(ApiEnrolmentReader::new())
            ->setWriter(
                PdoWriterWithTransformer::new(),
                ApiEnrolmentTransformer::new()->setTags($tags)
            )
            ->run();
    }

}
