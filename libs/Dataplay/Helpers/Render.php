<?php

namespace Libs\Dataplay\Helpers;

use Illuminate\Support\Collection;

class Render
{
    public const INI = 'ini';
    public const ELM = 'elm';
    public const END = 'end';

    public static function element(
        array $values,
        string $template,
        ?array $formatters = []
    ): string
    {
        $search = [];
        $replace = [];

        foreach ($formatters as $key => $callback) {
            if (!isset($values[$key])) {
                $values[$key] = null;
            }
        }

        foreach ($values as $key => $value) {
            $key = strtolower($key);

            if (isset($formatters[$key])) {
                $value = $formatters[$key]($value, $values);
            }

            if (is_array($value)) {
                $value = print_r($value, true);
            }

            if (!is_scalar($value)) {
                continue;
            }

            $search[] = '{' . strtolower($key) . '}';
            $replace[] = $value;
        }

        return str_replace($search, $replace, $template);
    }

    public static function collection(
        Collection|array $data,
        array $template,
        ?array $marks = [],
        ?array $formatters = []
    ): string
    {
        $render = [];
        $position = 0;

        $render[] = $template['ini'];

        foreach ($data as $index => $element) {
            if (is_object($element) && method_exists($element, 'toArray')) {
                $element = $element->toArray();
            }

            if (is_object($element)) {
                $element = (array) $element;
            }

            $element['_index'] = $index;
            $element['_position'] = ++$position;

            // atributos de elemento calculados
            if (!empty($template['compute'])) {
                foreach ($template['compute'] as $key => $fn) {
                    $element[$key] = $fn($element);
                }
            }

            // contemplar template custom
            $elementTemplate = isset($element['template'])
                ? "template-{$element['template']}"
                : 'elm';


            $render[] = self::element(
                $element,
                $template[$elementTemplate],
                $formatters
            );
        }

        $render[] = $template['end'];

        $rendered = implode('', $render);

        if (is_array($marks)) {
            $marks = self::arrayFlat($marks);
            $rendered = self::element($marks, $rendered, $formatters);
        }

        return $rendered;
    }

    private static function arrayFlat(array $values, $prefix = '', $sep = '.')
    {
        static $flat = array();

        foreach ($values as $key => $value) {
            if (is_array($value)) {
                self::arrayFlat($value, $prefix . $key . $sep);
            } else {
                $flat[$prefix . $key] = $value;
            }
        }

        return $flat;
    }
}
