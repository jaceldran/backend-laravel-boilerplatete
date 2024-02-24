<?php

namespace Modules\Enrolments\Commands;

use Illuminate\Console\Command;
use Modules\Enrolments\Workflows\DynamicsEntityWorkflow;
use Modules\Enrolments\Workflows\EnrolmentApiWorkflow;
use Modules\Enrolments\Workflows\EnrolmentEtlWorkflow;

class EnrolmentEtlCommand extends Command
{
    protected $signature = 'enrolment:etl {run?}';

    public function handle()
    {
        match ($this->argument('run')) {
            'api' => $this->apiWorkflow(),
            'etl' => $this->etlWorkflow(),
            'dyn' => $this->dynamicsEntityWorkflow(),
            default => $this->all()
        };

        return self::SUCCESS;
    }

    private function all(): void
    {
        $this->apiWorkflow();
        $this->etlWorkflow();
        $this->dynamicsEntityWorkflow();
    }

    private function dynamicsEntityWorkflow(): void
    {
        $this->info(DynamicsEntityWorkflow::class);
        DynamicsEntityWorkflow::start($this);
    }

    private function apiWorkflow(): void
    {
        $this->info(EnrolmentApiWorkflow::class);
        EnrolmentApiWorkflow::start($this);
    }

    private function etlWorkflow(): void
    {
        $this->info(EnrolmentEtlWorkflow::class);
        EnrolmentEtlWorkflow::start($this);
    }
}
