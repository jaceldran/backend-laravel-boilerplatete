<?php

namespace Packages\Dataplay\Traits;

use Packages\Dataplay\Contracts\TransformerInterface;

trait WithTransformer
{
    public function withTransformer(TransformerInterface $transformer): static
    {
        $this->transformer = $transformer;

        return $this;
    }
}
