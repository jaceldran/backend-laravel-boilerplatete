<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $table = 'system_commands';

    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->comment('Configuraciones de comandos del sistema');
            $table->uuid('id')->primary();
            $table->string('name')->index();
            $table->string('description')->index();
            $table->string('signature')->index();
            $table->string('tags')->nullable()->index();
            $table->json('last_run_data')->nullable();
            $table->timestamp('last_run')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->unique(['type', 'name',]);
        });

    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
