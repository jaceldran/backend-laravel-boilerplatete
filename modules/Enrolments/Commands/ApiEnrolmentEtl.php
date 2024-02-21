<?php

namespace Modules\Enrolments\Commands;

use Illuminate\Console\Command;
use Modules\Enrolments\Workflows\ApiEnrolmentWorkflow;

class ApiEnrolmentEtl extends Command
{
    protected $signature = 'enrolment:api-etl';

    public function handle()
    {
        ApiEnrolmentWorkflow::start($this);

        return self::SUCCESS;
    }
}
