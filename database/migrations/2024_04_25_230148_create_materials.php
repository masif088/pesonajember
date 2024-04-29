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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('note')->nullable();
            $table->decimal('stock')->default(0);
            $table->string('unit');
            $table->decimal('unit_per_purchase');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
