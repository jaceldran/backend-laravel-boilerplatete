<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\FakeSale;
use Illuminate\Http\Request;
use Packages\Highcharts\HighCharts;

class FakeSaleController extends Controller
{
    public function index()
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

        return Inertia::render('sales/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FakeSale $fakeSale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FakeSale $fakeSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FakeSale $fakeSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FakeSale $fakeSale)
    {
        //
    }
}
