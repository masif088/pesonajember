<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('production_forecasting_additional_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('additional_cost_id');
            $table->decimal('size')->default(0);
            $table->decimal('amount')->default(0);
            $table->decimal('price')->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('additional_cost_id','additional_cost')
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
        Schema::dropIfExists('production_forecasting_additional_costs');
    }
};
