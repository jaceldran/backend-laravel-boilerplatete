<?php

namespace Modules\System\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Inertia\Inertia;
use Modules\Shared\Controllers\Controller;
use Modules\System\Models\SystemCommand;

class SystemCommandController extends Controller
{
    public function index()
    {
        $query = SystemCommand::query()
            ->whereNot('subcommand', 'like', '%all%')
            ->orderBy('command')
            ->orderBy('subcommand');

        if ($search = request('q', null)) {
            $query->searchInColumns($search, ['command', 'subcommand', 'description']);
        }

        $commands = $query->get()->groupBy('command');

        $data = [
            'commands' => $commands,
            'q' => $search,
        ];

        return Inertia::render('system/commands/index', $data);
    }

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
