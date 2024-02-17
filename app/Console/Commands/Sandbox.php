<?php

namespace App\Console\Commands;

use Exception;
use App\Models\Enrolment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Packages\Dynamics\DynamicsModel;
use Packages\Dataplay\Helpers\Render;
use Illuminate\Support\Facades\Storage;
use Modules\DynamicsModels\DynamicsYear;

class Sandbox extends Command
{
    protected $signature = 'sandbox {--etl-years} {--dynamics} {--render}';

    public function handle()
    {
        if ($this->option('etl-years')) {
            $this->testEtlYears();
        }

        if ($this->option('dynamics')) {
            $this->testDynamicsSearch();
        }

        if ($this->option('render')) {
            $this->testRender();
        }

        return self::SUCCESS;
    }

    private function testEtlYears(): void
    {
        $year = DynamicsYear::new();

        $path = "dynamics/years.json";

        $this->info("leyendo years...");

        try {
            $result = $year->select([
                DynamicsYear::BIT_IDENTIFICADOR,
                DynamicsYear::BIT_PERIODO,
                DynamicsYear::BIT_PAIS,
                DynamicsYear::BIT_COMIENZAEL,
                DynamicsYear::BIT_TERMINAEL,
                DynamicsYear::STATECODE,
                DynamicsYear::STATUSCODE,
            ])
                ->orWhere(DynamicsYear::BIT_PERIODO, 'like', '%2023%')
                ->orWhere(DynamicsYear::BIT_PERIODO, 'like', '%2024%')
                ->orderBy(DynamicsYear::BIT_IDENTIFICADOR, 'asc')
                ->output()
                ->collection();
        } catch (Exception $e) {
            $result = ['error' => $e->getMessage()];
        }

        Storage::put($path, json_encode($result, JSON_PRETTY_PRINT));
    }

    private function testDynamicsSearch(): void
    {
        $contact = DynamicsModel::new('contact');

        $emails = [
            'isuka81@hotmail.com',
            'santifou@gmail.com',
            'jesus.gambin@gmail.com',
            'santiago@enae.es',
        ];

        foreach ($emails as $email) {
            $this->info("reading $email...");
            Log::info("reading $email...");
            $result = $contact
                ->select(['firstname', 'lastname', 'emailaddress1', 'emailaddress2'])
                ->where('emailaddress1', 'eq', $email)
                ->output(true)
                ->collection();
            Log::info(print_r($result, true));
        }
    }

    private function testRender(): void
    {
        $data = Enrolment::all()->take(3);

        echo Render::collection($data, [
            'ini' => '[START]' . PHP_EOL,
            'elm' => '{contact_email} - {product_id}' . PHP_EOL,
            'end' => '[END]' . PHP_EOL,
        ]);

        $this->info(__METHOD__);
    }
}
