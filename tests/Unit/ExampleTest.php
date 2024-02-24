<?php

namespace Tests\Unit;

use Modules\Payments\Workflows\PaymentEtlWorkflow;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function test_that_true_is_true(): void
    {

        PaymentEtlWorkflow::start();
    }
}
