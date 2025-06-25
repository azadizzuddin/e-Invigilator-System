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
        Schema::table('notifications', function (Blueprint $table) {
            // Drop foreign key constraint first
            $table->dropForeign(['schedule_id']);
            
            // Remove automated notification fields
            $table->dropColumn(['scheduled_at', 'schedule_id']);
            
            // Update type enum to remove 'automated'
            $table->enum('type', ['manual', 'bulk'])->default('manual')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Add back automated notification fields
            $table->timestamp('scheduled_at')->nullable();
            $table->unsignedBigInteger('schedule_id')->nullable();
            $table->foreign('schedule_id')->references('id')->on('surveillance_timetables')->onDelete('cascade');
            
            // Update type enum to include 'automated'
            $table->enum('type', ['manual', 'bulk', 'automated'])->default('manual')->change();
        });
    }
};
