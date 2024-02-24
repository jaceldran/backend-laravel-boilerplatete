<?php

namespace Modules\Payments\Readers;

use Libs\Dataplay\Helpers\UrlBuilder;
use Libs\Dataplay\Traits\Newable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\LazyCollection;
use Libs\Dataplay\Contracts\ReaderInterface;

class PaymentApiReader implements ReaderInterface
{
    use Newable;

    public function data(): LazyCollection
    {
        return LazyCollection::make(function () {

            $endpoint = UrlBuilder::new('https://service.enae.es/dynamics/api')
                ->addSegment('exports')
                ->addSegment('payments')
                ->build();

            $result = Http::get($endpoint)->json();

            foreach ($result as $enrolment) {
                yield $enrolment;
            }
        });
    }
}
