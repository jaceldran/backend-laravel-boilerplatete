<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $table = 'system_commands';

    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('command');
            $table->string('subcommand')->unique();
            $table->string('description')->index();
            $table->json('last_run_data')->nullable();
            $table->timestamp('last_run')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
