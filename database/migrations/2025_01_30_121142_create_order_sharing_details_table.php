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
        Schema::create('order_sharing_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_sharing_id');
            $table->unsignedBigInteger('order_product_id');
            $table->decimal('percentage');
            $table->timestamps();
            $table->foreign('order_sharing_id')->references('id')->on('order_sharings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_product_id')->references('id')->on('order_products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_sharing_details');
    }
};
