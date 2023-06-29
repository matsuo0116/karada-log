<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('log_id')->constrained('logs');
            $table->foreignId('type_id')->constrained('types');
            $table->integer('count');
            $table->integer('weight');
            $table->integer('sets');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_types');
    }
};
