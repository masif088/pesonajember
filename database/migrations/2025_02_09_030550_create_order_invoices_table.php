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
        Schema::create('order_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('partner_id');
            $table->string('invoice_number');
            $table->decimal('shipping_cost',16);
            $table->decimal('down_payment',16);
            $table->decimal('tax',16);
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->cascadeOnUpdate();
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('cascade')->cascadeOnUpdate();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_invoices');
    }
};
