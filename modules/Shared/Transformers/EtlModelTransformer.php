<?php

namespace Modules\Shared\Transformers;

use Libs\Dataplay\Traits\Newable;
use Modules\Shared\Models\EtlModel;
use Libs\Dataplay\Contracts\DataplayEntityInterface;
use Libs\Dataplay\Contracts\WithDataplayEntity;
use Libs\Dataplay\Contracts\TransformerInterface;

abstract class EtlModelTransformer implements TransformerInterface, WithDataplayEntity
{
    use Newable;

    protected DataplayEntityInterface $entity;
    protected array $tags = [];

    public function __construct()
    {
        $this->entity = $this->dataplayEntity();
    }

    public function setTags(array $tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    public function handle(array|object $rowValues): array|object
    {
        $this->entity->setValues($rowValues);

        $hashes = $this->entity->hashes();
        $values = $this->entity->values();
        $hasErrors = !$this->entity->validate();

        return [
            EtlModel::KEYS_HASH => $hashes[EtlModel::KEYS_HASH],
            EtlModel::DATA_HASH => $hashes[EtlModel::DATA_HASH],
            EtlModel::TAGS => implode(',', $this->tags),
            EtlModel::IS_ACTIVE => true,
            EtlModel::HAS_CHANGES => true,
            EtlModel::HAS_ERRORS => $hasErrors,
            EtlModel::COUNT => 1,
            EtlModel::DATA => json_encode($values),
        ];
    }
}
