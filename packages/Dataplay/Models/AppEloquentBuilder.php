<?php

namespace Packages\Dataplay\Models;

use Illuminate\Database\Eloquent\Builder;

class AppEloquentBuilder extends Builder
{
    public const AGGREGATE_SUM = 'sum';
    public const AGGREGATE_AVG = 'avg';
    public const AGGREGATE_MAX = 'max';
    public const AGGREGATE_MIN = 'min';
    public const AGGREGATE_COUNT = 'count';

    public const LEFT_JOIN = 'leftJoin';

    private const AGGREGATE_ALLOW = [
        self::AGGREGATE_AVG,
        self::AGGREGATE_COUNT,
        self::AGGREGATE_MAX,
        self::AGGREGATE_MIN,
        self::AGGREGATE_SUM,
    ];

    public function searchInColumns(string $searchTerm, array $columns): static
    {
        $words = explode(' ', trim($searchTerm));
        $where = [];

        foreach ($words as $word) {
            $likeWord = [];
            foreach ($columns as $column) {
                $likeWord[] = "$column like '%$word%'";
            }

            $where[] = "(" . implode(' or ', $likeWord) . ")";
        }

        $this->whereRaw(implode(' and ', $where));

        return $this;
    }

    public function selectAs(string $expression, string $alias): self
    {
        return $this->selectRaw($expression . ' as ' . $alias);
    }

    public function countAs(string $column, ?string $alias): self
    {
        $alias ??= $column;

        return $this->selectRaw('COUNT(' . $column . ') as ' . $alias);
    }

    public function sumAs(string $column, string|null $alias = null): self
    {
        $alias ??= $column;

        return $this->selectRaw('sum(' . $column . ') AS ' . $alias);
    }

    public function zeroAs(string $alias): self
    {
        return $this->selectRaw('0 as ' . $alias);
    }

    public function valueAs(string $expression, string $alias): self
    {
        return $this->selectRaw("$expression as $alias");
    }

    public function addMetric(string $expression, string $alias, $aggregateFunction = self::AGGREGATE_SUM): static
    {
        return $this->aggregateAs($expression, $alias, $aggregateFunction);
    }

    public function addDimension(string $expression, string $alias): static
    {
        $this->selectRaw("$expression as $alias");

        $this->groupByRaw($expression);

        return $this;
    }

    public function aggregateAs(string $expression, string $alias, string $aggregateFunction): self
    {
        if (!in_array($aggregateFunction, self::AGGREGATE_ALLOW)) {
            return $this;
        }

        return $this->selectRaw("$aggregateFunction($expression) as $alias");
    }
}
