<?php

namespace Libs\Dataplay\Traits;

use Libs\Dataplay\Contracts\TransformerInterface;

trait WithTransformer
{
    public function withTransformer(TransformerInterface $transformer): static
    {
        $this->transformer = $transformer;

        return $this;
    }
}
