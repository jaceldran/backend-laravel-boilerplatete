<?php

namespace Modules\Dynamics\Readers;

use Modules\Dynamics\Models\Year;
use Illuminate\Support\LazyCollection;
use Libs\Dataplay\Contracts\ReaderInterface;
use Libs\Dataplay\Traits\Newable;

class YearReader implements ReaderInterface
{
    use Newable;

    public function data(): LazyCollection
    {
        // ejemplo de regla dinámica, leer y actualizar solo los cursos que incluyen año actual
        $currentYear = date('Y');

        return Year::new()
            ->select([
                Year::BIT_IDENTIFICADOR,
                Year::BIT_PERIODO,
                Year::BIT_COMIENZAEL,
                Year::BIT_TERMINAEL,
            ])
            ->where(Year::BIT_PERIODO, 'like', "%{$currentYear}%")
            ->disableCache()
            ->compactResult(true)
            ->collection( /** aqui se podría pasar el transformer */);
    }
}
