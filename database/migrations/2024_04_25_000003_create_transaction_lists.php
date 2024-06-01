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
        Schema::create('transaction_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('transaction_detail_type_id');
            $table->unsignedBigInteger('transaction_list_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('shipper_id')->nullable();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->string('shipper_category')->nullable();
            $table->string('amount');
            $table->decimal('price',16,2);
            $table->timestamps();

            $table->foreign('transaction_id')
                ->on('transactions')
                ->references('id')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->foreign('transaction_list_id')
                ->on('transaction_lists')
                ->references('id')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->foreign('status_id')
                ->on('transactions')
                ->references('id')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->foreign('transaction_detail_type_id')
                ->on('transaction_detail_types')
                ->references('id')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreign('product_id')
                ->on('products')
                ->references('id')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreign('shipper_id')
                ->on('shippers')
                ->references('id')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_lists');
    }
};
