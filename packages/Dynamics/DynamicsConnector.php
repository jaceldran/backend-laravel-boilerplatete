<?php

namespace Packages\Dynamics;

use AlexaCRM\WebAPI\Client;
use AlexaCRM\WebAPI\ClientFactory;

class DynamicsConnector
{
    private Client $client;

    public function __construct()
    {
        $this->client = ClientFactory::createOnlineClient(
            config('services.dynamics.instance_uri'),
            config('services.dynamics.application_id'),
            config('services.dynamics.application_secret')
        );
    }

    public static function new(): static
    {
        return new static();
    }

    public function client(): Client
    {
        return $this->client;
    }
}
