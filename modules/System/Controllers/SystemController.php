<?php

namespace Modules\System\Controllers;

use Inertia\Inertia;
use Modules\Shared\Controllers\Controller;

class SystemController extends Controller
{
    public function __invoke()
    {
        // $commands = $this->commands();

        if ($search = request('q', null)) {
            //     //     $models->searchInColumns($search, ['type', 'name', 'data']);
        }

        $data = [
            // 'commands' => $commands,
            'q' => $search,
        ];

        return Inertia::render('system/index', $data);
    }

    // private function commands(): array
    // {
    //     $commands['dynamics:etl']['list']['dynamics:etl model-configs'] = [
    //         'description' => 'Conecta con Dynamics y actualiza las configuraciones de los modelos especificados en <kbd>config/dynamics.php</kbd>.',
    //     ];

    //     $commands['enrolment:etl']['list']['enrolment:etl api'] = [
    //         'description' => 'Conecta con la api de <kbd>service.enae.es</kbd> y actualiza la tabla <kbd>etl.enrolments</kbd>.',
    //     ];

    //     $commands['enrolment:etl']['list']['enrolment:etl etl'] = [
    //         'description' => 'Traslada los datos de <kbd>etl.enrolments</kbd> a <kbd>service.enrolment_form</kbd>.',
    //     ];

    //     $commands['enrolment:etl']['list']['enrolment:etl dyn'] = [
    //         'description' => 'Actualiza la tabla <kbd>service.dynamics_entity</kbd> leyendo de Dynamics las entidades vinculadas a los enrolments de <kbd>service.enrolment_form</kbd>.',
    //     ];


    //     return $commands;
    // }

    public function show(string $systemCommand)
    {
        $data = [
            'command' => [
                'signature' => $systemCommand,
                'last_run_date' => now()->subHours(3)->toDateTimeString(),
                'last_run_log' => [],
            ],
        ];

        return view('command-show', $data);

        // return Inertia::render("system/commands/show", $data);
    }
}
