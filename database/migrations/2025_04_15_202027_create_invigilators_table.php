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
        Schema::create('invigilators', function (Blueprint $table) {
            $table->id();
            $table->String('userID')->unique();
            $table->String('userPassword');
            $table->String('userName');
            $table->String('position');
            $table->String('faculty');
            $table->String('contact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invigilators');
    }
};
