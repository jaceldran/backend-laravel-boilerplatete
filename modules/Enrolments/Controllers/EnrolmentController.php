<?php

namespace Modules\Enrolments\Controllers;

use Inertia\Inertia;
use Modules\Enrolments\Models\DynamicsEntity;
use Modules\Enrolments\Models\Enrolment;
use Modules\Shared\Controllers\Controller;
use Modules\Enrolments\Requests\StoreEnrolmentRequest;
use Modules\Enrolments\Requests\UpdateEnrolmentRequest;

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
        $entities = ['lead', 'contact', 'opportunity'];

        foreach ($entities as $entityName) {
            $column = "{$entityName}_id";
            $prop = "dynamics_{$entityName}";

            if ($entityId = $enrolment->{$column}) {
                $data[$prop] = [
                    'error' => "$entityName $entityId not found"
                ];

                $found = DynamicsEntity::new()->newQuery()
                    ->where('entity_name', $entityName)
                    ->where('entity_id', $entityId)
                    ->get()
                    ->first();

                if ($found) {
                    $data[$prop] = $found;
                }
            }
        }

        $data['enrolment'] = $enrolment;

        // return $data;

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
