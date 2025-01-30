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
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('ppn')
                ->after('status')
                ->nullable();

            $table->decimal('pph')
                ->after('ppn')
                ->nullable();
        });

        Schema::table('order_products', function (Blueprint $table) {
            $table->decimal('hpp',16)
                ->after('value')
                ->nullable();

            $table->decimal('hpp_value',16)
                ->after('hpp')
                ->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(array_merge([
                'ppn',
                'pph',
            ]));
        });
        Schema::table('order_products', function (Blueprint $table) {
            $table->dropColumn(array_merge([
                'hpp',
                'hpp_value',
            ]));
        });
    }
};
