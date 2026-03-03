<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tubewells', function (Blueprint $table) {
            $table->id();
            $table->string('area_name')->nullable();
            $table->double('lat');
            $table->double('lng');
            $table->enum('status', ['safe', 'danger', 'untested'])->default('untested');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tubewells');
    }
};