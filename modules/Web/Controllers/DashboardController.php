<?php

namespace Modules\Web\Controllers;

use Inertia\Inertia;
use Libs\Highcharts\HighCharts;
use Modules\Enae\Models\FakeSale;

class DashboardController
{
    public function index()
    {
        return Inertia::render('dashboards/index');
    }

    public function marketing()
    {
        $sales = FakeSale::query()
            ->selectRaw('date')
            ->selectRaw('customer')
            ->selectRaw('category')
            ->selectRaw('product')
            ->selectRaw('amount/100 as amount')
            ->orderBy('date', 'desc');

        $salesByProduct = clone (FakeSale::query())
            ->selectRaw('product')
            ->selectRaw('sum(amount)/1 as amount')
            ->groupBy('product');

        $salesByCategory = clone (FakeSale::query())
            ->selectRaw('category')
            ->selectRaw('sum(amount)/1 as amount')
            ->groupBy('category');

        $hc = HighCharts::new();

        $data = [
            'sales' => $sales->paginate(10),

            'salesByProduct' => [
                'name' => 'Ventas por producto',
                'data' => $hc->buildSerie('product', 'amount', $salesByProduct->get()),
            ],

            'salesByCategory' => [
                'name' => 'Ventas por categoría',
                'data' => $hc->buildSerie('category', 'amount', $salesByCategory->get()),
            ],
        ];


        return Inertia::render('dashboards/marketing', $data);
    }
}
