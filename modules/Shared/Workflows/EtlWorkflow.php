<?php

namespace Modules\Shared\Workflows;

use Libs\Dataplay\Workflow\Workflow;
use Libs\Dataplay\Contracts\ReaderInterface;
use Libs\Dataplay\Contracts\WriterInterface;
use Libs\Dataplay\Contracts\WithUpsertInterface;
use Libs\Dataplay\Contracts\TransformerInterface;
use Libs\Dataplay\Contracts\ReaderWithTransformerInterface;
use Libs\Dataplay\Contracts\WriterWithTransformerInterface;

class EtlWorkflow extends Workflow
{
    private const READING = 'reading';
    private const WRITING = 'writing';

    private $targetModel;
    private $reader;
    private $writer;


    public function setTargetModel(string|WithUpsertInterface $targetModel): static
    {
        $this->targetModel = is_string($targetModel)
            ? resolve($targetModel)
            : $targetModel;

        return $this;
    }

    public function setReader(string|ReaderInterface $reader): static
    {
        $this->reader = is_string($reader)
            ? resolve($reader)
            : $reader;

        return $this;
    }

    public function setReaderWithTransformer(
        string|ReaderWithTransformerInterface $reader,
        string|TransformerInterface $transformer = null
    ): static
    {
        $this->setReader($reader);

        $this->reader->withTransformer(
            is_string($transformer)
            ? resolve($transformer)
            : $transformer
        );

        return $this;
    }

    public function setWriter(string|WriterInterface $writer): static
    {
        $this->writer = is_string($writer)
            ? resolve($writer)
            : $writer;

        return $this;
    }

    public function setWriterWithTransformer(
        string|WriterWithTransformerInterface $writer,
        string|TransformerInterface $transformer = null
    ): static
    {
        $this->setWriter($writer);

        $this->writer->withTransformer(
            is_string($transformer)
            ? resolve($transformer)
            : $transformer
        );

        return $this;
    }

    public function run(): void
    {
        $this
            ->set('targetModel', $this->targetModel)
            ->set('reader', $this->reader)
            ->set('writer', $this->writer)
            ->addTask(
                class_basename($this->reader) . ' ' . self::READING . '...',
                function (Workflow $wf) {
                    dump(class_basename($this->reader) . ' ' . self::READING . '...');
                    $wf->data = $wf->reader->data();
                }
            )->addTask(
                class_basename($this->writer) . ' ' . self::WRITING . '...',
                function ($wf) {
                    dump(class_basename($this->writer) . ' ' . self::WRITING . '...');
                    $wf->writer
                        ->setTargetModel($wf->targetModel)
                        ->setData($wf->data)
                        ->writeData();
                }
            )->after(
                '',
                function (Workflow $wf) {
                    dump('Finish ' . $wf->name());
                    dump("Total read: " . $wf->data->count());
                }
            );

        parent::run();
    }
}
