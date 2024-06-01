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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('payment_model_id')->nullable();
            $table->unsignedBigInteger('shipper_id')->nullable();
            $table->unsignedBigInteger('transaction_status_id')->nullable();
            $table->string('uid')->nullable();
            $table->string('shipping_receipt_number')->nullable();
            $table->decimal('total_money',16,2)->nullable();
            $table->decimal('tax')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')
                ->on('customers')
                ->references('id')
                ->restrictOnUpdate()
                ->restrictOnDelete();

            $table->foreign('payment_model_id')
                ->on('payment_models')
                ->references('id')
                ->restrictOnUpdate()
                ->restrictOnDelete();

            $table->foreign('shipper_id')
                ->on('shippers')
                ->references('id')
                ->restrictOnUpdate()
                ->restrictOnDelete();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
