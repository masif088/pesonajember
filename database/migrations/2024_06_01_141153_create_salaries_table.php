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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('basic_salary', 11);
            $table->decimal('bonus', 11);
            $table->decimal('overtime', 11);
            $table->decimal('transportation', 11);
            $table->decimal('debt_deduction', 11);
            $table->decimal('employee_cooperative_deductions');
            $table->string('reference');
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
