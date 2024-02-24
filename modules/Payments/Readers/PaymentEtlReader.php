<?php

namespace Modules\Payments\Readers;

use Libs\Dataplay\Traits\Newable;
use Modules\Shared\Models\EtlModel;
use Illuminate\Support\LazyCollection;
use Libs\Dataplay\Contracts\ReaderInterface;

class PaymentEtlReader implements ReaderInterface
{
    use Newable;

    public function data(): LazyCollection
    {
        return EtlModel::new('payments')->cursor();
    }
}
