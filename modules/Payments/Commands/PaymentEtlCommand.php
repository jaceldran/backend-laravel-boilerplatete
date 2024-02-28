<?php

namespace Modules\Payments\Commands;

use App\Console\Commands\WithOutput;
use Illuminate\Console\Command;
use Modules\Payments\Workflows\PaymentApiWorkflow;
use Modules\Payments\Workflows\PaymentEtlWorkflow;

class PaymentEtlCommand extends Command
{
    use WithOutput;

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
        $this->output('** ' . __METHOD__);
        $this->api();
        $this->etl();
    }

    private function api(): void
    {
        $this->output('** ' . PaymentApiWorkflow::class . '...');
        $this->output(PaymentApiWorkflow::class);
        PaymentApiWorkflow::start($this);
        $this->output('** ' . __METHOD__);
    }

    private function etl(): void
    {
        $this->output('** ' . __METHOD__);
        $this->output(PaymentEtlWorkflow::class);
        PaymentEtlWorkflow::start($this);
    }
}
