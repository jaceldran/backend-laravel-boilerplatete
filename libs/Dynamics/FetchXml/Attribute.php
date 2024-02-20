<?php

namespace Libs\Dynamics\FetchXml;

final class Attribute
{
    public static function render(array $attributes): string
    {
        $lines = [];
        foreach ($attributes as $attribute) {
            $lines[] = sprintf('<attribute name="%s" />', $attribute);
        }

        return implode(PHP_EOL, $lines);
    }
}
