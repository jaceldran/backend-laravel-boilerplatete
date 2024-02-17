<?php

namespace Packages\Dynamics;

use Packages\Dataplay\Traits\Newable;
use Service\Cache;
use AlexaCRM\Xrm\Entity;
use AlexaCRM\WebAPI\Client;
use AlexaCRM\Xrm\ColumnSet;
use Packages\Dynamics\DynamicsQuery;
use AlexaCRM\Xrm\EntityReference;
use AlexaCRM\Xrm\EntityCollection;
use AlexaCRM\Xrm\Query\FetchExpression;
use Packages\Dynamics\DynamicsConnector;

class DynamicsModel
{
    public const CREATEDON = 'createdon';
    public const MODIFIEDON = 'modifiedon';
    public const STATECODE = 'statecode';
    public const STATUSCODE = 'statuscode';
    public const STATECODE_ACTIVE = '0';
    public const STATECODE_INACTIVE = '1';
    public const STATUSCODE_ACTIVE = '1';
    public const STATUSCODE_INACTIVE = '2';

    public const COMPACT = 1;
    public const NO_COMPACT = 0;

    protected Client $client;
    protected DynamicsQuery $query;
    protected EntityCollection|array $result;
    protected string $entityName;
    protected bool $compactResult = true;
    protected array $optionsAttributes = [];
    protected array $linkedAttributes = [];
    protected array $preserveAttributes = [];
    protected ?array $cache;
    protected bool $cacheIsEnabled = false;

    use Newable;

    public function __construct()
    {
        if (!empty($this->entityName)) {
            $this->query = new DynamicsQuery($this->entityName);
        }

        $this->client = DynamicsConnector::new()->client();
    }

    // public function __construct(?string $entityName = null)
    // {
    //     if (!empty($entityName)) {
    //         $this->entityName = $entityName;
    //         $this->query = new DynamicsQuery($entityName);
    //     }

    //     $this->client = DynamicsConnector::new()->client();
    // }

    // public static function new(?string $entityName = null): static
    // {
    //     return new static($entityName);
    // }

    public function enableCache(): static
    {
        $this->cacheIsEnabled = true;

        return $this;
    }

    public function collection(): EntityCollection|array
    {
        $query = $this->query->build();
        $fetchExpression = new FetchExpression($query);
        $result = $this->client->RetrieveMultiple($fetchExpression);

        if ($this->compactResult) {
            $result = $this->compactCollection($result);
        }

        // reset query
        $this->query = new DynamicsQuery($this->entityName);

        return $result;
    }

    public function read(string $entityId, ?array $columns = []): array|Entity|null
    {
        // $cachePath = __DIR__ . "/../../dynamics/cache/{$this->entityName}-{$entityId}.json";

        // $result = Cache::readJson($cachePath);

        // if ($this->cacheIsDisabled || empty($result))
        // {
        if (empty($columns)) {
            $columnSet = new ColumnSet(true);
        } else {
            $columnSet = new ColumnSet($columns);
        }

        $result = $this->client->Retrieve($this->entityName, $entityId, $columnSet);

        if ($this->compactResult && !empty($result)) {
            $result = $this->compactEntity($result);
        }

        //     Cache::saveJson($cachePath, $result);
        // }

        return $result;
    }

    public function compactCollection(EntityCollection $entityCollection): array
    {
        $data = [];

        foreach ($entityCollection->Entities as $entity) {
            $data[$entity->Id] = self::compactEntity($entity);
        }

        return $data;
    }

    public function compactEntity(Entity $entity): array
    {
        $values = [];

        foreach ($entity->Attributes as $key => $value) {
            // si el value es una referencia externa extraer el id
            // y aplanar el resto de atributos
            if (isset($value->Id)) {
                $values["{$key}"] = $value->Id;
                foreach ($value as $k => $v) {
                    if ($k === 'Id' || empty($v)) {
                        continue;
                    }
                    $k = strtolower($k);
                    $values["{$key}_{$k}"] = $v;
                }
                continue;
            }

            // si hay config optionsAttributes
            if (
                in_array($key, $this->optionsAttributes)
                && isset($entity->FormattedValues[$key])
            ) {
                $options = [];
                $optionValues = explode(',', $value);
                $optionTexts = explode(';', $entity->FormattedValues[$key]);

                foreach ($optionValues as $index => $optionValue) {
                    $options[$optionValue] = trim($optionTexts[$index]);
                }

                $value = $options;
            }

            $values[$key] = $value;
        }

        ksort($values);

        return array_merge(['id' => $entity->Id], $values);
    }

    public function create(string $entityName, array $values): string
    {
        $entity = new Entity($entityName);

        foreach ($values as $key => $value) {
            // asociar referencias entityId@entityName
            $p = explode('@', $key);
            if (count($p) === 2) {
                $ref = explode('@', $value);
                $refId = $ref[0];
                $refEntity = $ref[1];
                $entity[$p[1]] = new EntityReference($refEntity, $refId);

                unset($values[$key]);
                continue;
            }

            $entity[$key] = $value;
        }

        return $this->client->Create($entity);
    }

    public function update(string $entityName, string $entityId, array $values, ?array $linked = []): array
    {
        $entity = new Entity($entityName, $entityId);

        foreach ($values as $key => $value) {
            if (is_array($value)) {
                $value = implode(',', $value);
            }

            $entity[$key] = $value;

            if (array_key_exists($key, $linked)) {
                $entity[$key] = new EntityReference($linked[$key], $value);
            }
        }

        $response['request'] = [
            'entity_name' => $entityName,
            'entity_id' => $entityId,
            'values' => $values,
        ];

        try {
            $this->client->Update($entity); // @return void
        } catch (\Exception $e) {
            $response['error'] = true;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function __call(string $method, array $args): static
    {
        if (method_exists($this->query, $method)) {
            call_user_func_array([$this->query, $method], $args);
        }

        return $this;
    }
}
