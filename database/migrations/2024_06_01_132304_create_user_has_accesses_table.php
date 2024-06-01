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
        Schema::create('user_has_accesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_access_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
            ->cascadeOnUpdate()
            ->cascadeOnUpdate();
            $table->foreign('user_access_id')
                ->references('id')
                ->on('user_accesses')
                ->cascadeOnUpdate()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userhas_accesses');
    }
};
