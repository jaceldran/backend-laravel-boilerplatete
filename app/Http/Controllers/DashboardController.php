<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\FakeSale;
use Packages\Highcharts\HighCharts;

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
            ->selectRaw('amount')
            ->orderBy('date', 'desc');

        $salesByProduct = clone (FakeSale::query())
            ->selectRaw('product')
            ->selectRaw('sum(amount) as amount')
            ->groupBy('product');

        $salesByCategory = clone (FakeSale::query())
            ->selectRaw('category')
            ->selectRaw('sum(amount) as amount')
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
