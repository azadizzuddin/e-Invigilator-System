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
        Schema::create('surveillances', function (Blueprint $table) {
            $table->id();
            $table->String('userID');
            $table->String('userName');
            $table->String('position');
            $table->String('faculty');
            $table->String('role');
            $table->date('examDate');
            $table->String('examDay');
            $table->time('startTime');
            $table->String('startTimeAMPM');
            $table->time('endTime');
            $table->String('endTimeAMPM');
            $table->String('programCode');
            $table->String('courseCode');
            $table->String('group');
            $table->integer('totalStudent');
            $table->String('venue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveillances');
    }
};
