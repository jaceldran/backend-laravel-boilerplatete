<?php

namespace Libs\Dataplay\Contracts;

interface ReaderWithTransformerInterface extends ReaderInterface
{
    public function withTransformer(TransformerInterface $transformer): static;
}
