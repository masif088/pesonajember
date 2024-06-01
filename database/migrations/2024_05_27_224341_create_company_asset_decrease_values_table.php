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
        Schema::create('company_asset_decrease_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_asset_id');
            $table->decimal('shrinkage', 11);
            $table->integer('month');
            $table->integer('year');
            $table->timestamps();
            $table->foreign('company_asset_id')
                ->references('id')
                ->on('company_assets')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_asset_decrease_values');
    }
};
