<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('station_trip', function (Blueprint $table) {
            $table->id();

            $table->foreignId('trip_id')->constrained();
            $table->foreignId('station_id')->constrained();
            $table->integer('sequence');

            $table->index(['trip_id', 'station_id', 'sequence']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('station_trip');
    }
};
