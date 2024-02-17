<?php

namespace Packages\Dynamics\FetchXml;

final class LinkFilter
{
    public static function render(array $link_filters): string
    {
        $result = [];

        foreach ($link_filters as $entity => $filters) {
            $attribute = $entity; // asumes 1:1 relationship
            $result[] = sprintf('<link-entity name="%s" to="%s">', $entity, $attribute);
            $result[] = Filter::render($filters);
            $result[] = '</link-entity>';
        }

        return implode(PHP_EOL, $result);
    }
}
