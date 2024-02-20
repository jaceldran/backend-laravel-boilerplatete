<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    protected $connection = 'etl';

    public function up(): void
    {
        foreach ($this->tables() as $table) {
            Schema::create($table, function (Blueprint $table) {
                $table->string('keys_hash', 32)->primary();
                $table->string('data_hash', 32);
                $table->string('tags')->nullable()->index();
                $table->boolean('is_active')->default(true);
                $table->boolean('has_changes')->default(false);
                $table->boolean('has_errors')->default(false);
                $table->integer('count')->default(0);
                $table->json('data');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables() as $table) {
            Schema::dropIfExists($table);
        }
    }

    private function tables(): array
    {
        return [
            'diplomas',
            'dynamics_programs',
            'dynamics_years',
            'dynamics_enrolments',
            'dynamics_students',
        ];
    }
};
