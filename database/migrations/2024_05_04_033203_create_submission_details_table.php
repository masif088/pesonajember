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
        Schema::create('submission_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('submission_id');
            $table->unsignedBigInteger('material_id');
            $table->decimal('amount');
            $table->decimal('price',16,2);
            $table->timestamps();
            $table->foreign('submission_id')
                ->references('id')
                ->on('submission_details')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('material_id')
                ->references('id')
                ->on('materials')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_details');
    }
};
