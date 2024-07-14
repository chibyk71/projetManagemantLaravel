<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Ensure contractor_id is unsigned
            $table->unsignedBigInteger('contractor_id')->change();

            // Add foreign key constraint
            $table->foreign('contractor_id')
                ->references('id')
                ->on('contractors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['contractor_id']);

            // Optionally, you can change the column back to its original state if needed
            $table->bigInteger('contractor_id')->change();
        });
    }
};
