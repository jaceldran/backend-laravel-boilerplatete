<?php

namespace Packages\Dynamics;

/**
 * Servicio para construir un xml fetch expression.
 *
 * @see https://docs.microsoft.com/en-us/power-apps/developer/data-platform/use-fetchxml-construct-query
 *
 * @see https://docs.microsoft.com/en-us/power-apps/developer/data-platform/webapi/reference/about?view=dataverse-latest
 *
 * @see https://github.com/AlexaCRM/dynamics-webapi-toolkit/wiki/Tutorial
 */

use Packages\Dataplay\Helpers\Render;
use Packages\Dynamics\FetchXml\Filter;
use Packages\Dynamics\FetchXml\OrderBy;
use Packages\Dynamics\FetchXml\Attribute;
use Packages\Dynamics\FetchXml\LinkFilter;

class DynamicsQuery
{
    private string $entity = '';
    private array $filters = [];
    private array $linkFilters = [];
    private array $attributes = [];
    private string $pagingCookie = '';
    private string $orderByAttribute = '';
    private string $orderByDirection = '';
    private int $page = 0;
    private int $count = 0;
    private bool $enableOutput = false;

    public function __construct(string $entity)
    {
        $this->entity = $entity;
    }

    public function select(array $attributes = []): static
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function page(int $page, int $count): static
    {
        $this->page = $page;
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

    public function output(bool $enable = true): static
    {
        $this->enableOutput = $enable;

        return $this;
    }

    public function build(): string
    {
        $pagination = $this->page > 0 && $this->count > 0;

        $values = [
            'entity' => $this->entity,
            'attributes' => Attribute::render($this->attributes),
            'filters' => Filter::render($this->filters),
            'linkfilters' => LinkFilter::render($this->linkFilters),
            'orderby' => OrderBy::render($this->orderByAttribute, $this->orderByDirection),
            'paging-cookie' => $this->pagingCookie = '',
            'page' => $this->page,
            'count' => $this->count,
        ];

        $lines = array_filter(
            explode(PHP_EOL, Render::element($values, self::template($pagination))),
            fn($line) => !empty(trim($line))
        );

        $fetchExpression = implode(PHP_EOL, $lines);

        if ($this->enableOutput) {
            echo PHP_EOL . str_repeat('*', 80);
            echo PHP_EOL . $fetchExpression . PHP_EOL;
            echo str_repeat('*', 80) . PHP_EOL;
        }

        return $fetchExpression;
    }


    public static function template(bool $pagination = false): string
    {
        $lines = [];
        if ($pagination) {
            $lines[] = "<fetch mapping=\"logical\" "
                . "paging-cookie=\"{paging-cookie}\" "
                . "page=\"{page}\" count=\"{count}\">";
        } else {
            $lines[] = "<fetch mapping=\"logical\">";
        }
        $lines[] = "<entity name=\"{entity}\">";
        $lines[] = "{attributes}";
        $lines[] = "{filters}";
        $lines[] = "{linkfilters}";
        $lines[] = "{orderby}";
        $lines[] = "</entity>";
        $lines[] = "</fetch>";

        return implode(PHP_EOL, $lines);
    }
}
