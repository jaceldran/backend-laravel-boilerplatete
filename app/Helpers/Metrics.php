<?php

namespace App\Helpers;

final class Metrics
{
    public static function ratio(?float $dividend, ?float $divider): float
    {
        if ($divider == 0 || is_null($divider)) {
            return 0.0;
        }

        if ($dividend == 0 || is_null($dividend)) {
            return 0.0;
        }

        return (float) ($dividend / $divider);
    }

    public static function diffRatio(?float $current, ?float $previous, int $precision = 8): float
    {
        $diff = round($current - $previous, $precision);

        if ($diff == 0) {
            return 0.0;
        }

        if ($previous == 0) {
            return 1.0;
        }

        return self::ratio($diff, $previous);
    }

    public static function percentage(float $dividend, float $divider, $decimals = 2): float
    {
        return round(self::ratio($dividend, $divider) * 100, $decimals);
    }
}
