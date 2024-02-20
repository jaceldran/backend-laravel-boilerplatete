<?php

namespace Libs\Dynamics\FetchXml;

final class Filter
{
    public const AND = 'and';
    public const OR = 'or';

    public static function render(array $filters): string
    {
        $lines = [];

        foreach ($filters as $filterType => $conditions) {
            $lines[] = sprintf('<filter type="%s">', $filterType);

            foreach ($conditions as $condition) {
                $lines[] = sprintf(
                    '<condition attribute="%s" operator="%s" value="%s" />',
                    $condition['attribute'],
                    $condition['operator'],
                    $condition['value'],
                );
            }

            $lines[] = '</filter>';
        }

        return implode(PHP_EOL, $lines);
    }
}
