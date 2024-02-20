<?php

use Modules\Dynamics\Commands\DynamicsEtl;
use Modules\Dynamics\Commands\DynamicsSandbox;

$dynamics = match (env('DYNAMICS_ENV')) {
    'sandbox' => [
        'env' => env('DYNAMICS_ENV'),
        'instance_uri' => env('DYNAMICS_SANDBOX_INSTANCE_URI'),
        'application_id' => env('DYNAMICS_SANDBOX_APPLICATION_ID'),
        'application_secret' => env('DYNAMICS_SANDBOX_APPLICATION_SECRET'),
    ],
    'production' => [
        'env' => env('DYNAMICS_ENV'),
        'instance_uri' => env('DYNAMICS_INSTANCE_URI'),
        'application_id' => env('DYNAMICS_APPLICATION_ID'),
        'application_secret' => env('DYNAMICS_APPLICATION_SECRET'),
    ],
    default => []
};

$dynamics['commands'] = [
    DynamicsEtl::class,
    DynamicsSandbox::class,
];

return $dynamics;
