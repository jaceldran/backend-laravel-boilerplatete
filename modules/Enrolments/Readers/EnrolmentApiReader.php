<?php

namespace Modules\Enrolments\Readers;

use Libs\Dataplay\Helpers\UrlBuilder;
use Libs\Dataplay\Traits\Newable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\LazyCollection;
use Libs\Dataplay\Contracts\ReaderInterface;

class EnrolmentApiReader implements ReaderInterface
{
    use Newable;

    public function data(): LazyCollection
    {
        return LazyCollection::make(function () {

            $endpoint = UrlBuilder::new('https://service.enae.es/dynamics/api')
                ->addSegment('exports')
                ->addSegment('enrolments')
                ->build();

            $result = Http::get($endpoint)->json();

            foreach ($result as $enrolment) {
                yield $enrolment;
            }
        });
    }
}
