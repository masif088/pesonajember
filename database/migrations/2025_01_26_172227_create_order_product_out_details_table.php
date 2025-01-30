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
        Schema::create('order_product_out_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_product_out_id');
            $table->unsignedBigInteger('order_product_id');
            $table->decimal('quantity', 16);
            $table->timestamps();
            $table->foreign('order_product_out_id')->references('id')->on('order_product_outs')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('order_product_id')->references('id')->on('order_products')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product_out_details');
    }
};
