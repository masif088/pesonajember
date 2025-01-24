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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_type_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('user_id');
            $table->string('order_number')->unique();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->foreign('transaction_type_id')
                ->references('id')
                ->on('transaction_types')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('order_partners');
        Schema::dropIfExists('orders');
    }
};
