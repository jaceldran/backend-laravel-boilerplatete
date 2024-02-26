<?php

namespace Modules\System\Controllers;

use Inertia\Inertia;
use Modules\System\Models\SystemModel;
use Modules\Shared\Controllers\Controller;
use Modules\System\Requests\StoreSystemModelRequest;
use Modules\System\Requests\UpdateSystemModelRequest;

class SystemModelController extends Controller
{
    public function index()
    {
        $models = SystemModel::query()
            ->orderBy('type')
            ->orderBy('name')
        ;

        if ($search = request('q', null)) {
            $models->searchInColumns($search, ['type', 'name', 'data']);
        }

        $data = [
            'models' => $models->paginate(10),
            'q' => $search,
        ];

        return Inertia::render('system/models/index', $data);
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
    public function store(StoreSystemModelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SystemModel|string $systemModel)
    {
        if (is_string($systemModel)) {
            $systemModel = SystemModel::query()->find($systemModel);
        }

        $data = [
            'model' => $systemModel,
        ];

        return Inertia::render("system/models/show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SystemModel $systemModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSystemModelRequest $request, SystemModel $systemModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SystemModel $systemModel)
    {
        //
    }
}
