<?php

namespace Modules\Payments\Transformer;

use Libs\Dataplay\Traits\Newable;
use Illuminate\Support\Facades\Log;
use Libs\Dataplay\Contracts\TransformerInterface;

class PaymentEtlTransformer implements TransformerInterface
{
    use Newable;

    public function handle(array|object $rowValues): array|object
    {
        $row = $rowValues->data;

        return [
            'id' => $row['id'],
            'source_type' => $row['source_type'] ?? '',
            'source_name' => $row['source_name'] ?? '',
            'source_id' => $row['source_id'] ?? '',
            'reference' => $row['reference'] ?? '',
            'method' => $row['method'] ?? '',
            'result' => $row['result'] ?? '',
            'amount' => $row['amount'] ?? '0',
            'attempts' => $row['attempts'] ?? '0',
            'created_at' => $row['created_at'] ?? now()->toDateTimeString(),
            'data' => json_encode($row['data'] ?? []),
        ];
    }
}
