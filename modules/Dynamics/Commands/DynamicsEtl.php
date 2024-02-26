<?php

namespace Modules\Dynamics\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Modules\Dynamics\Readers\ModelConfigReader;
use Modules\Dynamics\Transformers\ModelConfigTransformer;
use Modules\Dynamics\Workflows\ModelConfigEtlWorkflow;

class DynamicsEtl extends Command
{
    protected $signature = 'dynamics:etl {run?}';

    public function handle()
    {
        match ($this->argument('run')) {
            'model-configs' => $this->modelConfigs(),
            default => $this->default(),
        };

        return self::SUCCESS;
    }

    private function default(): void
    {
        $this->modelConfigs();
    }

    private function modelConfigs(): void
    {
        ModelConfigEtlWorkflow::start($this);

        // $data = ModelConfigReader::new()
        //     ->withTransformer(ModelConfigTransformer::new())
        //     ->data();

        // Storage::put('dynamics/all-models.json', json_encode($data->all(), JSON_PRETTY_PRINT));
    }
}
