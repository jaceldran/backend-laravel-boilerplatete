<?php

namespace Libs\Dynamics;

use AlexaCRM\WebAPI\Client;
use AlexaCRM\WebAPI\ClientFactory;
use Libs\Dataplay\Traits\Newable;

class DynamicsConnector
{
    use Newable;

    private Client $client;

    public function __construct()
    {
        $this->client = ClientFactory::createOnlineClient(
            config('dynamics.instance_uri'),
            config('dynamics.application_id'),
            config('dynamics.application_secret')
        );
    }

    public function client(): Client
    {
        return $this->client;
    }
}
