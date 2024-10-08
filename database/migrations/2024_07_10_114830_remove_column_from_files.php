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
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn("folder");
            $table->dropForeign('files_projectid_foreign');
            $table->dropColumn('projectId');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            $table->addColumn("string","folder",);
            $table->unsignedBigInteger('projectId');
            $table->foreign('projectId')->references('id')->on('projects');
        });
    }
};
