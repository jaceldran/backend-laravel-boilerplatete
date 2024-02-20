<?php

namespace Libs\Dataplay\Writers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\LazyCollection;
use Illuminate\Database\Eloquent\Model;
use Libs\Dataplay\Contracts\WriterWithTransformerInterface;
use Libs\Dataplay\Contracts\WithUpsertInterface;
use Libs\Dataplay\Contracts\TransformerInterface;
use Libs\Dataplay\Traits\Newable;
use Libs\Dataplay\Traits\WithTransformer;

class PdoWriterWithTransformer implements WriterWithTransformerInterface
{
    use WithTransformer;
    use Newable;

    protected LazyCollection $data;
    protected int $chunkSize = 100;
    protected Model & WithUpsertInterface $targetModel;
    protected TransformerInterface $transformer;

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
        $transformer = $this->transformer ?? null;

        $this->data
            ->chunk($this->chunkSize)
            ->each(
                function ($chunk) use ($targetModel, $transformer) {
                    if ($transformer) {
                        $chunk = $chunk->map(
                            fn($item) => $transformer->handle($item)
                        );
                    }

                    try{
                        $targetModel->upsert(
                            $chunk->toArray(),
                            $targetModel->upsertUniqueColumns(),
                            $targetModel->upsertUpdateColumns()
                        );
                    } catch(\Exception $exception) {
                        $error = $exception->getMessage();
                        Log::error($error);
                    }
                }
            );
    }
}
