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
        Schema::create('transaction_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('transaction_status_type_id');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('transaction_id')
                ->on('transactions')
                ->references('id')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('transaction_status_type_id')
                ->on('transaction_status_types')
                ->references('id')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('transaction_status_id')
                ->on('transaction_statuses')
                ->references('id')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_statuses');
    }
};
