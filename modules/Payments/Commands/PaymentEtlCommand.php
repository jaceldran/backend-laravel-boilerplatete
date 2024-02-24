<?php

namespace Modules\Payments\Commands;

use Illuminate\Console\Command;
use Modules\Payments\Workflows\PaymentApiWorkflow;
use Modules\Payments\Workflows\PaymentEtlWorkflow;

class PaymentEtlCommand extends Command
{
    protected $signature = 'payment:etl';

    public function handle()
    {
        $this->info(PaymentApiWorkflow::class);
        PaymentApiWorkflow::start($this);

        $this->info(PaymentEtlWorkflow::class);
        PaymentEtlWorkflow::start($this);

        return self::SUCCESS;
    }
}
