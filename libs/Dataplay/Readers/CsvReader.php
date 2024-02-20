<?php

namespace Libs\Dataplay\Readers;

use Illuminate\Support\LazyCollection;
use Libs\Dataplay\Traits\Newable;
use Libs\Dataplay\Traits\WithFile;
use Libs\Dataplay\Traits\WithTransformer;
use Libs\Dataplay\Contracts\TransformerInterface;
use Libs\Dataplay\Contracts\ReaderWithTransformerInterface;

class CsvReader implements ReaderWithTransformerInterface
{
    use Newable;
    use WithTransformer;
    use WithFile;

    private ?string $separator = ',';
    private TransformerInterface $transformer;

    public function setSeparator(string $separator): static
    {
        $this->separator = $separator;

        return $this;
    }

    public function data(): LazyCollection
    {
        $transformer = $this->transformer ?? null;

        return LazyCollection::make(function () use ($transformer) {
            if (($handle = fopen($this->path, "r")) !== false) {
                $keys = (array) fgetcsv($handle, null, $this->separator);
                $count = count($keys);
                for ($i = 0; $i < $count; $i++) {
                    $keys[$i] = trim($keys[$i], " ﻿\n\t");
                }

                while (($values = fgetcsv($handle, null, $this->separator)) !== false) {
                    $row = array_combine($keys, $values);

                    if ($transformer) {
                        $row = $transformer->handle($row);
                    }

                    yield $row;
                }

                fclose($handle);
            }
        });
    }
}
