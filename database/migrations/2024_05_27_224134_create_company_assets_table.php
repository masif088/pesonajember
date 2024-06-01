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
        Schema::create('company_assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_asset_category_id');
            $table->string('title');
            $table->integer('unit');
            $table->integer('month_acquisition');
            $table->integer('year_acquisition');
            $table->integer('useful_life');
            $table->decimal('last_shrinkage', 11, 2);
            $table->decimal('value', 11, 2);
            $table->decimal('value_now', 11, 2);
            $table->timestamps();
            $table->foreign('company_asset_category_id')
                ->references('id')
                ->on('company_asset_categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_assets');
    }
};
