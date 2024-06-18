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
        Schema::create('cooperative_credit_employee_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cooperative_credit_employee_id');
            $table->string('title');
            $table->date('date_transaction');
            $table->decimal('credit', 16, 2)->default(0);
            $table->decimal('debit', 16, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cooperative_credit_employee_details');
    }
};
