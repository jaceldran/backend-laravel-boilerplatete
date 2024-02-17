<?php

namespace Packages\Dataplay\Writers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\LazyCollection;
use Illuminate\Database\Eloquent\Model;
use Packages\Dataplay\Contracts\WriterWithTransformerInterface;
use Packages\Dataplay\Contracts\WithUpsertInterface;
use Packages\Dataplay\Contracts\TransformerInterface;

class PdoWriter implements WriterWithTransformerInterface
{
    protected LazyCollection $data;
    protected int $chunkSize = 100;
    protected array $updateColumns;
    protected array $uniqueByColumns;
    protected Model & WithUpsertInterface $targetModel;
    protected TransformerInterface $transformer;

    public static function new(): static
    {
        return new static();
    }

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

    public function withTransformer(TransformerInterface $transformer): static
    {
        $this->transformer = $transformer;

        return $this;
    }

    public function run(): void
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
