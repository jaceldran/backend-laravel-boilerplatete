<?php

namespace Packages\Dynamics\FetchXml;

final class OrderBy
{
    public static function render(string $attribute, string $direction = null): string
    {
        if (empty($attribute)) {
            return '';
        }

        $directionAttr = match ($direction) {
            'asc' => 'ascending',
            'desc' => 'descending',
            default => 'ascending'
        };

        return sprintf('<order attribute="%s" %s="true" />', $attribute, $directionAttr);
    }
}
