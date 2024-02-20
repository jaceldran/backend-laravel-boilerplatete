<?php

namespace Modules\Dynamics\Models;

use Libs\Dynamics\DynamicsModel;
use Libs\Dataplay\Models\DataplayEntity;
use Libs\Dataplay\Contracts\WithDataplayEntity;

class Year extends DynamicsModel implements WithDataplayEntity
{
    protected string $entityName = 'bit_cursoacademico';

    public const BIT_IDENTIFICADOR = 'bit_identificador';
    public const BIT_PERIODO = 'bit_periodo';
    public const BIT_PAIS = 'bit_pais';
    public const BIT_COMIENZAEL = 'bit_comienzael';
    public const BIT_TERMINAEL = 'bit_terminael';


    public function dataplayEntity(): DataplayEntity
    {
        return DataplayEntity::new()
            ->key(self::BIT_IDENTIFICADOR, 'required')
            ->data(self::BIT_PERIODO, 'nullable')
            ->data(self::BIT_PAIS, 'nullable')
            ->data(self::BIT_COMIENZAEL, 'nullable')
            ->data(self::BIT_TERMINAEL, 'nullable')
            ->data(self::CREATEDON, 'nullable')
            ->data(self::MODIFIEDON, 'nullable')
            ->data(self::STATECODE, 'nullable')
            ->data(self::STATUSCODE, 'nullable');
    }
}
