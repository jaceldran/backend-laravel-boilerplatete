<?php

namespace Packages\Dataplay\Readers;

use Illuminate\Support\LazyCollection;
use Packages\Dataplay\Traits\WithFile;
use Packages\Dataplay\Traits\WithTransformer;
use Packages\Dataplay\Contracts\TransformerInterface;
use Packages\Dataplay\Contracts\ReaderWithTransformerInterface;

class CsvReader implements ReaderWithTransformerInterface
{
    use WithTransformer;
    use WithFile;

    private ?string $separator = ',';
    private TransformerInterface $transformer;

    public static function new(): static
    {
        return new static();
    }

    public function setSeparator(string $separator): static
    {
        $this->separator = $separator;

        return $this;
    }

    public function run(): LazyCollection
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
