<?php

namespace Modules\System\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Artisan;
use Modules\System\Models\SystemCommand;
use Modules\Shared\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class SystemCommandController extends Controller
{
    public function index()
    {
        $query = SystemCommand::query()
            // ->whereNot('subcommand', 'like', '%all%')
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
    }

    public function run(string|SystemCommand $systemCommand)
    {
        if (is_string($systemCommand)) {
            $systemCommand = SystemCommand::query()->find($systemCommand);
        }

        // ob_start();

        Artisan::call($systemCommand->subcommand);

        // $output = ob_get_clean();

        $data = [
            'command' => $systemCommand->subcommand,
            'output' => '$output',
        ];

        return view('command-show', $data);
    }
}
