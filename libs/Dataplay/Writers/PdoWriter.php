<?php

namespace Libs\Dataplay\Writers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\LazyCollection;
use Illuminate\Database\Eloquent\Model;
use Libs\Dataplay\Contracts\WithUpsertInterface;
use Libs\Dataplay\Contracts\WriterInterface;
use Libs\Dataplay\Traits\Newable;

class PdoWriter implements WriterInterface
{
    use Newable;

    protected LazyCollection $data;
    protected int $chunkSize = 100;
    protected Model & WithUpsertInterface $targetModel;

    public function setChunkSize(int $chunkSize): static
    {
        $this->chunkSize = $chunkSize;

        return $this;
    }

    public function setTargetModel(Model & WithUpsertInterface $targetModel): static
    {
        $this->targetModel = $targetModel;

        return $this;
    }

    public function setData(LazyCollection $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function writeData(): void
    {
        $targetModel = $this->targetModel;

        // dd($this->targetModel->getTable(),__METHOD__);

        $this->data
            ->chunk($this->chunkSize)
            ->each(
                function ($chunk) use ($targetModel) {
                    try{
                        $targetModel->upsert(
                            $chunk->toArray(),
                            $targetModel->upsertUniqueColumns(),
                            $targetModel->upsertUpdateColumns()
                        );
                    } catch(\Exception $exception) {
                        $error = $exception->getMessage();
                        Log::error( $error );
                        dd(substr($error,0, 150));
                    }
                }
            );
    }
}
