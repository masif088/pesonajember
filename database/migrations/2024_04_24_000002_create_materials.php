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
            $table->string('code');
            $table->string('title');
            $table->text('note')->nullable();
            $table->decimal('stock')->default(0);
            $table->decimal('minimum_stock')->default(0);
            $table->decimal('value',16,0)->default(0);
            $table->string('unit')->nullable();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('material_category_id');
            $table->timestamps();
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreign('material_category_id')
                ->references('id')
                ->on('material_categories')
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
