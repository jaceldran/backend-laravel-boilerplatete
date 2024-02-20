<?php

namespace Modules\Dynamics\Transformers;

use Modules\Dynamics\Models\Year;

class EtlYearTransformer extends EtlModelTransformer
{
    public function __construct()
    {
        $this->setEntity(Year::new()->dataplayEntity());
    }
}
