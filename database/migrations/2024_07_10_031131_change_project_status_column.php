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
        Schema::table('projects', function (Blueprint $table) {
            $table->enum("status",['IN_PROGRESS','ON_HOLD','COMPLETED','NOT_STARTED','CANCELED'])->default('IN_PROGRESS')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->enum('status', ['IN_PROGRESS', 'COMPLETED', 'CANCELLED'])->default('IN_PROGRESS')->change();
        });
    }
};
