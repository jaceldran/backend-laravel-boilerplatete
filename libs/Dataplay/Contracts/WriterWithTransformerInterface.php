<?php

namespace Libs\Dataplay\Contracts;

interface WriterWithTransformerInterface extends WriterInterface
{
    public function withTransformer(TransformerInterface $transformer): static;
}
