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
        Schema::create('order_product_outs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('partner_id');
            $table->text('note')->nullable();
            $table->text('reference_product_out')->nullable();
            $table->text('proof_of_product_out')->nullable();
            $table->date('date_product_out')->nullable();

            $table->text('reference_waybill')->nullable();
            $table->text('proof_of_waybill')->nullable();
            $table->date('date_waybill')->nullable();
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product_outs');
    }
};
