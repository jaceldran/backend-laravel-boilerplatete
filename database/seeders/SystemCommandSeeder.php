<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\System\Models\SystemCommand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SystemCommandSeeder extends Seeder
{
    public function run(): void
    {
        $data[] = [
            'id' => Str::uuid(),
            'command' => 'dynamics:etl',
            'subcommand' => 'dynamics:etl models',
            'description' => 'Conecta con Dynamics y rellena la tabla system_models con '
                . 'las configuraciones de los modelos especificados en config/dynamics.php.',
        ];

        $data[] = [
            'id' => Str::uuid(),
            'command' => 'enrolment:etl',
            'subcommand' => 'enrolment:etl all',
            'description' => 'Ejecuta todos los subcomandos de enrolment:etl: api, etl y dynamics',
        ];

        $data[] = [
            'id' => Str::uuid(),
            'command' => 'enrolment:etl',
            'subcommand' => 'enrolment:etl api',
            'description' => 'Conecta con service.enae.es y actualiza la tabla etl.enrolments.',
        ];

        $data[] = [
            'id' => Str::uuid(),
            'command' => 'enrolment:etl',
            'subcommand' => 'enrolment:etl etl',
            'description' => 'Traslada los datos de etl.enrolments a service.enrolment_form.',
        ];

        $data[] = [
            'id' => Str::uuid(),
            'command' => 'enrolment:etl',
            'subcommand' => 'enrolment:etl dynamics',
            'description' => 'Conecta con Dynamics y rellena la tabla service.dynamics_entity con las entidades lead, contact y opportunity que estén vinculadas a los enrolments.',
        ];

        $data[] = [
            'id' => Str::uuid(),
            'command' => 'payment:etl',
            'subcommand' => 'payment:etl all',
            'description' => 'Ejecuta todos los subcomandos de enrolment:etl: api y etl',
        ];

        $data[] = [
            'id' => Str::uuid(),
            'command' => 'payment:etl',
            'subcommand' => 'payment:etl api',
            'description' => 'Conecta con la api de service.enae.es y actualiza la tabla etl.payments.',
        ];

        $data[] = [
            'id' => Str::uuid(),
            'command' => 'payment:etl',
            'subcommand' => 'payment:etl etl',
            'description' => 'Traslada los datos de etl.payments a service.payment'
        ];

        SystemCommand::query()->upsert(
            $data,
            ['subcommand'],
            ['command', 'description']
        );
    }
}
