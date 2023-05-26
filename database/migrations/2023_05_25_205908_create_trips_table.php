<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();

            $table->foreignId('source')->constrained(table: 'stations');
            $table->foreignId('destination')->constrained(table: 'stations');
            $table->foreignId('bus_id')->constrained();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
