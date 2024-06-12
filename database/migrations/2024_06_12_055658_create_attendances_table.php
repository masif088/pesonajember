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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('attendance_status_id');
            $table->timestamp('entrance_attendance_by_web')->nullable();
            $table->timestamp('discharge_attendance_by_web')->nullable();
            $table->timestamp('entrance_attendance_by_fingerprint')->nullable();
            $table->timestamp('discharge_attendance_by_fingerprint')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('master_id')
                ->references('id')
                ->on('attendance_masters')
                ->restrictOnUpdate()
                ->restrictOnDelete();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->restrictOnUpdate()
                ->restrictOnDelete();
            $table->foreign('attendance_status_id')
                ->references('id')
                ->on('attendance_statuses')
                ->restrictOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
