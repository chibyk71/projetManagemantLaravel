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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('contractor_id')->unsigned();
            $table->string('project_number');
            $table->dateTime('date_of_award');
            $table->string('contract_sum');
            $table->dateTime('start_date');
            $table->dateTime('due_date');
            $table->dateTime('canceled_date')->nullable();
            $table->dateTime('completed_date')->nullable();
            $table->enum('status', ['IN_PROGRESS', 'COMPLETED', 'CANCELLED'])->default('IN_PROGRESS');
            $table->float('progress');
            $table->text('desc');
            $table->string('created_by_id')->nullable();
            $table->string('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
