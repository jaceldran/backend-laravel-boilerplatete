<?php

namespace Packages\Dataplay\Contracts;

interface ReaderWithTransformerInterface extends ReaderInterface
{
    public function withTransformer(TransformerInterface $transformer): static;
}
