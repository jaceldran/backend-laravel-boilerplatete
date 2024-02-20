<?php

namespace Modules\Web\Controllers;

use Inertia\Inertia;
use Modules\Enae\Models\Payment;
use Modules\Web\Requests\StorePaymentRequest;
use Modules\Web\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::query()
            ->orderBy('created_at', 'desc');

        if ($query = request('q', null)) {
            $payments->searchInColumns($query, [
                'reference',
                'source_type',
                'source_name',
                'source_id',
                'amount',
                'data'
            ]);
        }

        $data = [
            'payments' => $payments->paginate(10),
            'query' => $query,
        ];

        return Inertia::render('payments/index', $data);
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
    public function store(StorePaymentRequest $request)
    {
        //
    }

    public function show(Payment $payment)
    {
        $data['payment'] = $payment;

        return Inertia::render('payments/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
