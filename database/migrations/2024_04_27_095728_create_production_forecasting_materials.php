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
        Schema::create('production_forecasting_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->decimal('size');
            $table->decimal('amount');
            $table->decimal('price');
            $table->timestamps();

            $table->foreign('material_id')
                ->references('id')
                ->on('additional_costs')
                ->restrictOnDelete()
                ->restrictOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_forecasting_materials');
    }
};
