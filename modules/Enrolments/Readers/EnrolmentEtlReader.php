<?php

namespace Modules\Enrolments\Readers;

use Libs\Dataplay\Traits\Newable;
use Modules\Shared\Models\EtlModel;
use Illuminate\Support\LazyCollection;
use Libs\Dataplay\Contracts\ReaderInterface;

class EnrolmentEtlReader implements ReaderInterface
{
    use Newable;

    public function data(): LazyCollection
    {
        return EtlModel::new('enrolments')->cursor();
    }
}
