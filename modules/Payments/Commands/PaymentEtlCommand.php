<?php

namespace Modules\Payments\Commands;

use Illuminate\Console\Command;
use Modules\Payments\Workflows\PaymentApiWorkflow;
use Modules\Payments\Workflows\PaymentEtlWorkflow;

class PaymentEtlCommand extends Command
{
    protected $signature = 'payment:etl {run?}';

    public function handle()
    {
        match ($this->argument('run')) {
            'api' => $this->api(),
            'etl' => $this->etl(),
            'all' => $this->all()
        };

        return self::SUCCESS;
    }

    private function all(): void
    {
        $this->info('** ' . __METHOD__);
        $this->api();
        $this->etl();
    }

    private function api(): void
    {
        $this->info('** ' . __METHOD__);
        $this->info(PaymentApiWorkflow::class);
        PaymentApiWorkflow::start($this);
    }

    private function etl(): void
    {
        $this->info('** ' . __METHOD__);
        $this->info(PaymentEtlWorkflow::class);
        PaymentEtlWorkflow::start($this);
    }
}
