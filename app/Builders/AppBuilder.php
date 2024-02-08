<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class AppBuilder extends Builder
{
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

        $this->getQuery()->whereRaw(implode(' and ', $where));

        // $this->query()->whereRaw(implode(' and ', $where));

        return $this;
    }

}
