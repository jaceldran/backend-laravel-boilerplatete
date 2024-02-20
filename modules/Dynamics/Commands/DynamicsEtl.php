<?php

namespace Modules\Dynamics\Commands;

use Illuminate\Console\Command;
use Modules\Dynamics\Workflows\EtlYearWorkflow;

class DynamicsEtl extends Command
{
    protected $signature = 'dynamics:etl';

    public function handle()
    {
        EtlYearWorkflow::start($this);

        return self::SUCCESS;
    }
}
