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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('userID');
            $table->string('userName');
            $table->string('chat_id')->nullable();
            $table->string('contact')->nullable();
            $table->string('title');
            $table->text('message');
            $table->enum('type', ['manual', 'automated'])->default('manual');
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->text('error_message')->nullable();
            $table->unsignedBigInteger('schedule_id')->nullable();
            $table->timestamps();

            $table->foreign('schedule_id')->references('id')->on('surveillance_timetables')->onDelete('cascade');
            $table->index(['userID', 'status']);
            $table->index(['scheduled_at', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
