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
            $table->integer('target_weight');
            $table->integer('target_fat_per');
            $table->integer('age');
            $table->integer('height');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('target_weight');
            $table->dropColumn('target_fat_per');
            $table->dropColumn('age');
            $table->dropColumn('height');
        });
    }
};
