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
            $table->dropColumn(array_merge([
                'ppn',
                'pph',
            ]));
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('ppn')
                ->after('status')
                ->default(11);
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
    }
};
