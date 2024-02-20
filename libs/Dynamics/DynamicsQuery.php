<?php

namespace Libs\Dynamics;

/**
 * Servicio para construir un xml fetch expression.
 *
 * @see https://docs.microsoft.com/en-us/power-apps/developer/data-platform/use-fetchxml-construct-query
 *
 * @see https://docs.microsoft.com/en-us/power-apps/developer/data-platform/webapi/reference/about?view=dataverse-latest
 *
 * @see https://github.com/AlexaCRM/dynamics-webapi-toolkit/wiki/Tutorial
 */

use Libs\Dynamics\FetchXml\Filter;
use Libs\Dynamics\FetchXml\OrderBy;
use Libs\Dynamics\FetchXml\Attribute;
use Libs\Dynamics\FetchXml\LinkFilter;

class DynamicsQuery
{
    private string $entity = '';
    private array $filters = [];
    private array $linkFilters = [];
    private array $attributes = [];
    private string $orderByAttribute = '';
    private string $orderByDirection = '';
    private int $page = 0;
    private int $count = 0;
    private bool $debug = false;
    private bool $debugAndStop = false;

    public function __construct(string $entity)
    {
        $this->entity = $entity;
    }

    public function select(array $attributes = []): static
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function page(int $page): static
    {
        $this->page = $page;

        return $this;
    }

    public function count(int $count): static
    {
        $this->count = $count;

        return $this;
    }

    private function addFilterCondition(
        string $filterType,
        string $attribute,
        string $operator,
        ?string $value = null
    ): static
    {
        if (empty($value)) {
            return $this;
        }

        $this->filters[$filterType][] = [
            'attribute' => $attribute,
            'operator' => $operator,
            'value' => $value,
        ];

        return $this;
    }

    public function where(string $attribute, string $operator, ?string $value): static
    {
        $this->addFilterCondition(Filter::AND , $attribute, $operator, $value);

        return $this;
    }

    public function orWhere(string $attribute, string $operator, ?string $value): static
    {
        $this->addFilterCondition(Filter::OR , $attribute, $operator, $value);

        return $this;
    }

    public function whereLink(string $entity, string $attribute, string $operator, ?string $value): static
    {
        if (!empty($value)) {
            $this->linkFilters[$entity][Filter::AND ][] = [
                'attribute' => $attribute,
                'operator' => $operator,
                'value' => $value,
            ];
        }

        return $this;
    }

    public function orderBy(string $attribute, string $direction = null): static
    {
        $this->orderByAttribute = $attribute;
        $this->orderByDirection = $direction;

        return $this;
    }

    public function debug(bool $debugAndStop = false): static
    {
        $this->debug = true;
        $this->debugAndStop = $debugAndStop;

        return $this;
    }

    public function build(): string
    {
        $lines = [];

        if ($this->page > 0 && $this->count > 0) {
            $lines[] = sprintf('<fetch mapping="logical" page="%d" count="%d">', $this->page, $this->count);
        } elseif ($this->count > 0) {
            $lines[] = sprintf('<fetch mapping="logical" count="%d">', $this->count);
        } else {
            $lines[] = '<fetch mapping="logical">';
        }

        $lines[] = sprintf('<entity name="%s">', $this->entity);

        if (!empty($this->attributes)) {
            $lines[] = Attribute::render($this->attributes);
        }

        if (!empty($this->filters)) {
            $lines[] = Filter::render($this->filters);
        }

        if (!empty($this->linkFilters)) {
            $lines[] = LinkFilter::render($this->linkFilters);
        }

        if (!empty($this->orderByAttribute)) {
            $lines[] = OrderBy::render($this->orderByAttribute, $this->orderByDirection);
        }

        $lines[] = "</entity>";

        $lines[] = "</fetch>";

        $fetchExpression = implode(PHP_EOL, $lines);

        if ($this->debug) {
            echo PHP_EOL . str_repeat('*', 80);
            echo PHP_EOL . $fetchExpression . PHP_EOL;
            echo str_repeat('*', 80) . PHP_EOL;
            if ($this->debugAndStop) {
                dd(__METHOD__);
            }
        }

        return $fetchExpression;
    }
}
