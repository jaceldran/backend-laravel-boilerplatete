<?php

namespace Modules\Dynamics\Models;

use Packages\Dynamics\DynamicsModel;

class Year extends DynamicsModel
{
    protected string $entityName = 'bit_cursoacademico';

    public const BIT_PERIODO = 'bit_periodo';
    public const BIT_IDENTIFICADOR = 'bit_identificador';
    public const BIT_PAIS = 'bit_pais';
    public const BIT_COMIENZAEL = 'bit_comienzael';
    public const BIT_TERMINAEL = 'bit_terminael';
}
