<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $table = 'system_models';

    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->comment('Configuraciones de modelos de datos');
            $table->uuid('id')->primary();
            $table->string('type')->index();
            $table->string('name')->index();
            $table->string('tags')->nullable()->index();
            $table->json('data');
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
