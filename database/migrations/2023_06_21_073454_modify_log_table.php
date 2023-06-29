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
        Schema::table('logs', function (Blueprint $table) {
            $table->double('weight', 4, 1)->nullable()->change();
            $table->double('fat_per', 3, 1)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->double('weight', 4, 1)->nullable(false)->change();
            $table->double('fat_per', 3, 1)->nullable(false)->change();
        });
    }
};
