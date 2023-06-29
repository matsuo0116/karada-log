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
        Schema::table('users', function (Blueprint $table) {
            $table->string('target_weight')->nullable()->change();
            $table->string('target_fat_per')->nullable()->change();
            $table->string('age')->nullable()->change();
            $table->string('height')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('target_weight')->nullable(false)->change();
            $table->string('target_fat_per')->nullable(false)->change();
            $table->string('age')->nullable(false)->change();
            $table->string('height')->nullable(false)->change();
        });
    }
};
