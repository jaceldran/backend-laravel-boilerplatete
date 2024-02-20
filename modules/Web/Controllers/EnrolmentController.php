<?php

namespace Modules\Web\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Modules\Enae\Models\Enrolment;
use Modules\Web\Requests\StoreEnrolmentRequest;
use Modules\Web\Requests\UpdateEnrolmentRequest;

class EnrolmentController extends Controller
{
    public function index()
    {
        $enrolments = Enrolment::query()
            ->orderBy('created_at', 'desc');

        if ($query = request('q', null)) {
            $enrolments->searchInColumns($query, ['contact_email', 'product_id', 'data']);
        }

        $data = [
            'enrolments' => $enrolments->paginate(10),
            'query' => $query,
        ];

        return Inertia::render('enrolments/index', $data);
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
    public function store(StoreEnrolmentRequest $request)
    {
        //
    }

    public function show(Enrolment $enrolment)
    {
        $data['enrolment'] = $enrolment;

        return Inertia::render('enrolments/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrolment $enrolment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnrolmentRequest $request, Enrolment $enrolment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrolment $enrolment)
    {
        //
    }
}
