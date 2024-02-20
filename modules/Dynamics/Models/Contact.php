<?php

namespace Modules\Dynamics\Models;

use Libs\Dynamics\DynamicsModel;

class Contact extends DynamicsModel
{
    protected string $entityName = 'contact';

    public const FIRSTNAME = 'firstname';
    public const LASTNAME = 'lastname';
    public const EMAILADDRESS1 = 'emailaddress1';
    public const EMAILADDRESS2 = 'emailaddress2';
    public const EMAILADDRESS3 = 'emailaddress3';
}
