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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id');
            $table->string('code');
            $table->string('title');
            $table->string('size');
            $table->string('photo_product');
            $table->integer('stock');
            $table->integer('price');
            $table->integer('custom_status');
            $table->integer('display_status');
            $table->text('note')->nullable();
            $table->unsignedBigInteger('product_category_id');
            $table->timestamps();
            $table->foreign('product_category_id')
                ->references('id')
                ->on('product_categories')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_forecastings');
    }
};
