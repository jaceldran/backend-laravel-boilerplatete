<?php

namespace Modules\Shared\Workflows;

use Libs\Dataplay\Workflow\Workflow;
use Libs\Dataplay\Contracts\ReaderInterface;
use Libs\Dataplay\Contracts\WriterInterface;
use Libs\Dataplay\Workflow\WorkflowException;
use Libs\Dataplay\Contracts\WithUpsertInterface;
use Libs\Dataplay\Contracts\TransformerInterface;
use Libs\Dataplay\Contracts\ReaderWithTransformerInterface;
use Libs\Dataplay\Contracts\WriterWithTransformerInterface;

class EtlWorkflow extends Workflow
{
    public function setTargetModel(WithUpsertInterface $targetModel): static
    {
        return $this->set('targetModel', $targetModel);
    }

    public function setReader(
        ReaderInterface|ReaderWithTransformerInterface $reader,
        ?TransformerInterface $transformer = null
    ): static
    {
        if ($transformer) {
            $reader = $reader->withTransformer($transformer);
        }

        return $this->set('reader', $reader);
    }

    public function setWriter(
        WriterInterface|WriterWithTransformerInterface $writer,
        ?TransformerInterface $transformer = null
    ): static
    {
        if ($transformer) {
            $writer = $writer->withTransformer($transformer);
        }

        return $this->set('writer', $writer);
    }

    public function run(): static
    {
        $this
            ->addTask(
                'Reading ' . class_basename($this->reader),
                function (Workflow $wf) {
                    $wf->context->info('Reading...');
                    $wf->data = $wf->reader->data();

                    // $wf->context->info(print_r($wf->data->all(), true));
                    // die();
                }
            )
            ->addTask(
                'Writing ' . class_basename($this->writer),
                function ($wf) {
                    $wf->context->info('Writing...');
                    $wf->writer
                        ->setTargetModel($wf->targetModel)
                        ->setData($wf->data)
                        ->writeData();
                }
            )
            ->after(
                '',
                function (Workflow $wf) {
                    $wf->context->info('Finish');
                    // $q = $wf->targetModel->newQuery()->where('data', 'like', '%2024%');
                    // $c = $q->count();
        
                    $wf->logInfo(
                        ''
                        // " - ($c) " . $q->toRawSql()
                        . '- Total read: ' . $wf->data->count()
                        //. ' - Total changes: ' . $wf->targetModel->where('has_changes', true)->count()
                    );
                }
            )
            ->setErrorHandler(
                fn(WorkflowException $exception, Workflow $wf) => $wf->logError(
                    $exception->getMessage()
                    . ' - file: ' . $exception->getFile()
                    . ' line: ' . $exception->getLine()
                )
            );

        return parent::run();
    }
}
