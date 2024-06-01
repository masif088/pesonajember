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
        Schema::create('product_additional_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('account_name_id');
            $table->decimal('amount')->default(0);
            $table->decimal('price')->default(0);
            $table->text('note')->nullable();
            $table->timestamps();
            $table->foreign('account_name_id')
                ->references('id')
                ->on('account_names')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
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
