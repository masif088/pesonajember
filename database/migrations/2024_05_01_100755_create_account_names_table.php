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
        Schema::create('account_names', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('level');
            $table->unsignedBigInteger('account_category_id');
            $table->unsignedBigInteger('status_id');
            $table->string('title');
            $table->integer('additional_cost');
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('account_category_id')->references('id')->on('account_categories')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('status_id')->references('id')->on('statuses')->restrictOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_names');
    }
};
