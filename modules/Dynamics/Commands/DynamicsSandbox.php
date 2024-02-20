<?php

namespace Modules\Dynamics\Commands;

use App\Models\Enrolment;
use Illuminate\Console\Command;
use Modules\Dynamics\Models\Lead;
use Modules\Dynamics\Models\Program;
use Modules\Dynamics\Models\TrainingArea;
use Modules\Dynamics\Models\User;
use Modules\Dynamics\Models\Year;
use Illuminate\Support\Facades\Log;
use Modules\Dynamics\Models\Account;
use Modules\Dynamics\Models\Contact;
use Modules\Dynamics\Models\Country;
use Modules\Dynamics\Models\Product;
use Modules\Dynamics\Models\Business;
use Modules\Dynamics\Models\Province;
use Libs\Dataplay\Helpers\Render;
use Illuminate\Support\Facades\Storage;
use Modules\Dynamics\Models\Opportunity;
use Modules\Dynamics\Models\Municipality;
use Libs\Dynamics\DynamicsModel;

class DynamicsSandbox extends Command
{
    protected $signature = 'dynamics:sandbox {--samples} {--definitions} {--search} {--render}';

    protected string $dynamicsEnv;

    public function handle()
    {
        $this->dynamicsEnv = config('dynamics.env');

        if ($this->option('definitions')) {
            $this->dynamicsDefinitions();
        }

        if ($this->option('samples')) {
            $this->dynamicsSamples();
        }

        if ($this->option('search')) {
            $this->testDynamicsSearch();
        }

        if ($this->option('render')) {
            $this->testRender();
        }

        return self::SUCCESS;
    }

    private function dynamicsSamples(): void
    {
        $this->call('log:clear');

        $dynmodels = [
            'account' => Account::new(),
            'business' => Business::new(),
            'contact' => Contact::new(),
            'bit_pais' => Country::new(),
            'lead' => Lead::new(),
            'bit_municipio' => Municipality::new(),
            'opportunity' => Opportunity::new(),
            'product' => Product::new(),
            'bit_programaacademico' => Program::new(),
            'bit_provincia' => Province::new(),
            'bit_areadeformacion' => TrainingArea::new(),
            'user' => User::new(),
            'bit_cursoacademico' => Year::new(),
        ];

        foreach ($dynmodels as $entityName => $dynmodel) {
            $path = "dynamics/{$entityName}-samples-{$this->dynamicsEnv}.json";

            $this->info("Leyendo $entityName...");

            $result = $dynmodel
                ->disableCache()
                ->compactResult(true)
                ->count(10)
                ->collection();

            Storage::put($path, json_encode($result, JSON_PRETTY_PRINT));
        }
    }

    private function dynamicsDefinitions(): void
    {
        $dynModel = DynamicsModel::new();

        $entities = [
            'annotation',
            'account',
            'businessunit',
            'contact',
            'bit_pais',
            'lead',
            'bit_municipio',
            'opportunity',
            'product',
            'bit_programaacademico',
            'bit_provincia',
            'bit_areadeformacion',
            'systemuser',
            'bit_cursoacademico',
        ];

        foreach ($entities as $entity) {
            $this->info("Leyendo definiciones de $entity...");
            $dynModel->setEntity($entity);

            $metadaAttributes = $dynModel->metadataAttributes();
            Storage::put(
                "dynamics/{$entity}-attributes-metadata-{$this->dynamicsEnv}.json",
                json_encode($metadaAttributes, JSON_PRETTY_PRINT)
            );

            $attributesSummary = $dynModel->attributesSummary();
            Storage::put(
                "dynamics/{$entity}-attributes-summary-{$this->dynamicsEnv}.json",
                json_encode($attributesSummary, JSON_PRETTY_PRINT)
            );

            // $picklists = $dynModel->picklists();
            // Storage::put(
            //     "dynamics/picklists-$entity.json",
            //     json_encode($picklists, JSON_PRETTY_PRINT)
            // );
        }
    }

    private function testDynamicsSearch(): void
    {
        $this->call('log:clear');

        $contact = Contact::new();

        $emails = [
            'isuka81@hotmail.com',
            'santifou@gmail.com',
            'matias@enae.es',
            'santiago@enae.es',
        ];

        foreach ($emails as $email) {
            $this->info("Searching $email...");
            Log::info("Searching $email...");
            $result = $contact
                ->select(['firstname', 'lastname', 'emailaddress1', 'emailaddress2', 'emailaddress3'])
                ->orWhere('emailaddress1', 'eq', $email)
                ->orWhere('emailaddress2', 'eq', $email)
                ->orWhere('emailaddress3', 'eq', $email)
                ->debug()
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
