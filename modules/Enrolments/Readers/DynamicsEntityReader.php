<?php

namespace Modules\Enrolments\Readers;

use Libs\Dynamics\DynamicsModel;
use Illuminate\Support\LazyCollection;
use Libs\Dataplay\Contracts\ReaderInterface;
use Libs\Dataplay\Traits\Newable;
use Modules\Enrolments\Models\Enrolment;

class DynamicsEntityReader implements ReaderInterface
{
    use Newable;

    private array $data = [];

    public function __construct()
    {
        $columns = [
            'lead' => 'lead_id',
            'contact' => 'contact_id',
            'product' => 'product_id',
            'opportunity' => 'opportunity_id',
        ];

        $enrolments = Enrolment::query()->select($columns)->cursor();

        foreach ($columns as $entityName => $column) {
            $entityIds = $enrolments
                ->pluck($column)
                ->where(fn($value) => !empty($value))
                ->unique()
                ->toArray();

            $countIds = count($entityIds);

            $count = 0;
            foreach ($entityIds as $entityId) {
                $count++;
                dump("Reading $entityName $count/$countIds $entityId");

                $entity = DynamicsModel::new()
                    ->setEntity($entityName)
                    ->disableCache()
                    ->compactResult(true)
                    ->read($entityId);

                if (is_null($entity)) {
                    continue;
                }

                $entity['entity_name'] = $entityName;

                $this->data[] = $entity;
            }
        }
    }

    public function data(): LazyCollection
    {
        $data = $this->data;

        return LazyCollection::make(function () use ($data) {
            foreach ($data as $item) {
                yield $item;
            }
        });
    }
}
