<?php

namespace Modules\Dynamics\Readers;

use Libs\Dataplay\Contracts\TransformerInterface;
use Libs\Dynamics\DynamicsModel;
use Libs\Dataplay\Traits\Newable;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\Storage;
use Libs\Dataplay\Traits\WithTransformer;
use Libs\Dataplay\Contracts\ReaderInterface;
use Libs\Dataplay\Contracts\ReaderWithTransformerInterface;
use Modules\Dynamics\Transformers\ModelConfigTransformer;

class ModelConfigReader implements ReaderWithTransformerInterface
{
    use Newable;
    use WithTransformer;

    private ModelConfigTransformer $transformer;

    public function data(): LazyCollection
    {
        $dynModel = DynamicsModel::new();
        $models = config('dynamics.models');
        $data = [];

        foreach ($models as $entityName) {
            dump("Reading $entityName");

            $data[$entityName] = $dynModel
                ->setEntity($entityName)
                ->disableCache()
                ->metadataSummary();
        }

        $transformer = $this->transformer;

        return LazyCollection::make(function () use ($data, $transformer) {
            foreach ($data as $entityName => $entitySummary) {
                $transformer->setType('dynamics')->setName($entityName);
                yield $transformer->handle($entitySummary);
            }
        });
    }
}
