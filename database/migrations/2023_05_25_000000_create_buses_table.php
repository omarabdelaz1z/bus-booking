<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->integer('capacity')->default(12);
            $table->integer('occupied_seats')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};