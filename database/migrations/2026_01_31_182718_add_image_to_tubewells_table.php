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
    Schema::table('tubewells', function (Blueprint $table) {
        // Adding the image column after the status column
        $table->string('image')->nullable()->after('status');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('tubewells', function (Blueprint $table) {
        // Removing the column if we rollback
        $table->dropColumn('image');
    });
}
};
