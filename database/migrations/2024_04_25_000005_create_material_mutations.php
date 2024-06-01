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
        Schema::create('material_mutations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('material_mutation_status_id');
            $table->decimal('amount')->nullable();
            $table->decimal('value')->nullable();
            $table->decimal('stock')->nullable();
            $table->text('reference')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('material_mutation_status_id')
                ->on('material_mutation_statuses')
                ->references('id')
                ->restrictOnUpdate()
                ->restrictOnDelete();

            $table->foreign('material_id')
                ->on('materials')
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
        Schema::dropIfExists('material_mutations');
    }
};
