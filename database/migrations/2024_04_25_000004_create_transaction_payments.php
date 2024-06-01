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
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('payment_status_id');
            $table->unsignedBigInteger('bank_id');
            $table->string('title');
            $table->dateTime('payment_at');
            $table->string('schema');
            $table->decimal('amount',16,2);
            $table->decimal('amount_confirmation',16,2);
            $table->text('note');
            $table->timestamps();

            $table->foreign('transaction_id')
                ->on('transactions')
                ->references('id')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreign('bank_id')
                ->on('banks')
                ->references('id')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreign('payment_status_id')
                ->on('payment_statuses')
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
        Schema::dropIfExists('transaction_payments');
    }
};
