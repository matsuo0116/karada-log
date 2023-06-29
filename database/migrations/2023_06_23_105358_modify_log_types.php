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
        Schema::table('log_types', function (Blueprint $table) {
            $table->integer('count')->nullable()->change();
            $table->integer('sets')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('log_types', function (Blueprint $table) {
            $table->integer('count')->nullable(false)->change();
            $table->integer('sets')->nullable(false)->change();
        });
    }
};
