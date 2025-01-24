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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('partner_id');
            $table->string('name');
            $table->decimal('price',16);
            $table->decimal('quantity',16);
            $table->decimal('value',16);
            $table->timestamps();
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('partner_id')
                ->references('id')
                ->on('partners')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
