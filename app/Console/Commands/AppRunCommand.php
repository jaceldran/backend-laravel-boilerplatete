<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AppRunCommand extends Command
{
    use WithOutput;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run {run?}';


    public function handle()
    {
        match ($this->argument('run')) {
            'init' => $this->init(),
            'etl' => $this->etl(),
            'all' => $this->all(),
            default => $this->default(),
        };

        return self::SUCCESS;
    }

    private function default(): void
    {
        $this->output('** ' . $this->signature . ' ' . __METHOD__);
    }

    private function all(): void
    {
        $this->info('** ' . __METHOD__);
        $this->init();
        $this->etl();
    }

    private function init(): void
    {
        $this->info('** ' . __METHOD__);
        $this->call('migrate:refresh');
        $this->call('db:seed');
    }

    private function etl(): void
    {
        $this->info('** ' . __METHOD__);
        $this->call('payment:etl', ['run' => 'all']);
        $this->call('enrolment:etl', ['run' => 'all']);
        $this->call('dynamics:etl', ['run' => 'all']);
    }


}
