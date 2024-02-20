<?php

namespace Libs\Dynamics;

use Carbon\Carbon;
use AlexaCRM\Xrm\Entity;
use AlexaCRM\WebAPI\Client;
use AlexaCRM\Xrm\ColumnSet;
use AlexaCRM\Xrm\EntityReference;
use AlexaCRM\Xrm\EntityCollection;
use Illuminate\Support\LazyCollection;
use Libs\Dynamics\DynamicsQuery;
use AlexaCRM\WebAPI\MetadataRegistry;
use Libs\Dataplay\Traits\Newable;
use AlexaCRM\Xrm\Query\FetchExpression;
use Libs\Dynamics\DynamicsConnector;

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
    protected DynamicsQuery $query;
    protected EntityCollection|array $result;
    protected string $entityName;
    protected bool $compactResult = true;
    protected array $optionsAttributes = [];
    protected array $linkedAttributes = [];
    protected array $preserveAttributes = [];
    protected ?array $cache;
    protected bool $isCacheDisabled = true;
    protected Carbon $cacheExpiration;

    use Newable;

    public function __construct(protected ?Client $client = null)
    {
        if (!empty($this->entityName)) {
            $this->setEntity($this->entityName);
        }

        if (empty($this->client)) {
            $connector = resolve(DynamicsConnector::class);
            $this->setClient($connector->client());
        }

        $this->cacheExpiration = now()->addMinutes(15);
    }

    public function setEntity(string $entityName): static
    {
        $this->entityName = $entityName;
        $this->query = new DynamicsQuery($this->entityName);

        return $this;
    }

    public function setClient(Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function enableCache(?Carbon $expiration = null): static
    {
        $this->isCacheDisabled = false;
        $this->cacheExpiration = $expiration ?? now()->addMinutes(15);

        return $this;
    }

    public function disableCache(): static
    {
        $this->isCacheDisabled = true;

        return $this;
    }

    public function metadataAttributes(): array
    {
        $cacheKey = config('services.dynamics.env') . '-' . "metadata-{$this->entityName}";
        $metadata = cache($cacheKey);

        if (empty($metadata)) {
            $metadataRegistry = new MetadataRegistry($this->client);
            $metadata = $metadataRegistry->getDefinition($this->entityName)->Attributes;
            cache([$cacheKey => $metadata], now()->addDay());
        }

        return $metadata;
    }

    public function attributesSummary(): array
    {
        $attributesSummary = [];
        $metadataAttributes = $this->metadataAttributes();

        foreach ($metadataAttributes as $attributeName => $attribute) {
            $picklist = [];
            if ((string) $attribute->AttributeType === 'Picklist') {
                $picklist = [];
                $options = $attribute->OptionSet->Options;
                foreach ($options as $key => $option) {
                    $picklist[$key] = $option->Label->UserLocalizedLabel->Label;
                }
            }

            $summary = [
                'AttributeType' => $attribute->AttributeType,
                'Display' => $attribute->DisplayName->UserLocalizedLabel->Label ?? '-',
                'Description' => $attribute->Description->UserLocalizedLabel->Label ?? '-',
                'EntityLogicalName' => $attribute->EntityLogicalName ?? '-',
                'LogicalName' => $attribute->LogicalName ?? '-',
                'IsRetrievable' => $attribute->IsRetrievable,
                'IsSearchable' => $attribute->IsSearchable,
                'IsSecured' => $attribute->IsSecured,
                'IsValidForCreate' => $attribute->IsValidForCreate,
                'IsValidForRead' => $attribute->IsValidForRead,
                'IsValidForUpdate' => $attribute->IsValidForUpdate,
                'Format' => $attribute->Format ?? '-',
                'MaxLength' => $attribute->MaxLength ?? '-',
            ];

            if (!empty($picklist)) {
                $summary['picklist'] = $picklist;
            }

            $attributesSummary[$attributeName] = $summary;
        }

        return $attributesSummary;
    }

    public function picklists(): array
    {
        $picklists = [];
        $metadataAttributes = $this->metadataAttributes();

        foreach ($metadataAttributes as $attributeName => $attribute) {
            if ((string) $attribute->AttributeType === 'Picklist') {
                $picklist = [];
                $options = $attribute->OptionSet->Options;
                foreach ($options as $key => $option) {
                    $picklist[$key] = $option->Label->UserLocalizedLabel->Label;
                }

                $picklists[$attributeName] = $picklist;
            }
        }

        return $picklists;
    }

    public function collection(): EntityCollection|LazyCollection
    {
        $query = $this->query->build();
        $fetchExpression = new FetchExpression($query);

        $cacheKey = md5(config('services.dynamics.env') . '-' . $query);
        $result = cache($cacheKey);

        if ($this->isCacheDisabled || empty($result)) {
            $result = $this->client->RetrieveMultiple($fetchExpression);
            cache([$cacheKey => $result], $this->cacheExpiration);
        }

        if ($this->compactResult) {
            $result = $this->compactCollection($result);
        }

        $this->query = new DynamicsQuery($this->entityName);

        return $result;
    }

    public function read(string $entityId, ?array $columns = []): array|Entity|null
    {
        $cacheKey = md5($this->entityName . '-' . $entityId . '-' . implode('-', $columns));
        $result = cache($cacheKey);

        if ($this->isCacheDisabled || empty($result)) {
            if (empty($columns)) {
                $columnSet = new ColumnSet(true);
            } else {
                $columnSet = new ColumnSet($columns);
            }

            $result = $this->client->Retrieve($this->entityName, $entityId, $columnSet);
            cache([$cacheKey => $result], $this->cacheExpiration);
        }

        if ($this->compactResult && !empty($result)) {
            $result = $this->compactEntity($result);
        }

        return $result;
    }

    public function compactResult(bool $compactResult): static
    {
        $this->compactResult = $compactResult;

        return $this;
    }

    public function compactCollection(EntityCollection $entityCollection): LazyCollection
    {
        return LazyCollection::make(function () use ($entityCollection) {
            foreach ($entityCollection->Entities as $entity) {
                yield self::compactEntity($entity);
                // $data[$entity->Id] = self::compactEntity($entity);
            }
        });
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
