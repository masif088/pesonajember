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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('status')->default(1);
            $table->string('kop')->nullable();
            $table->string('logo')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('format_number_invoice')->nullable();
            $table->string('format_number_driver')->nullable();
            $table->string('format_number_proof_of_cash')->nullable();
            $table->string('format_number_outcome')->nullable();
            $table->string('format_number_income')->nullable();
            $table->string('sign_name')->nullable();
            $table->string('sign_position')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
