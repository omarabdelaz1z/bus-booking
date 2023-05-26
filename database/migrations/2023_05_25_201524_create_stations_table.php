<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 20)->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
