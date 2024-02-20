<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'sqlite';

    public function up(): void
    {
        Schema::connection($this->connection)->create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('customer');
            $table->string('category');
            $table->string('product');
            $table->integer('amount');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('sales');
    }
};
