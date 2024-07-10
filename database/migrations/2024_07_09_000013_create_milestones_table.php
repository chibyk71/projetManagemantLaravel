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
        Schema::create('milestones', function (Blueprint $table) {
            $table->id();
            $table->foreignId("contractorId")->constrained("contractors")->cascadeOnDelete();
            $table->foreignId("projectId")->constrained("projects")->cascadeOnDelete();
            $table->float("progress");
            $table->enum("status",['YET_TO_COMMENCE','IN_PROGRESS','COMPLETED']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milestones');
    }
};
