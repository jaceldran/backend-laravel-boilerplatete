<?php

namespace Libs\Highcharts;

// use App\Traits\Newable;

class HighCharts
{
    use Newable;

    public function buildSerie(string $dimension, string $metric, $data)
    {
        $serie = [];

        foreach ($data as $item) {
            $serie[] = (object) [
                'name' => $item[$dimension],
                'y' => $item[$metric]
            ];
        }

        return $serie;
    }
}
