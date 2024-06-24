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
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('edit_count')->default(0);
        });
        Schema::table('transaction_lists', function (Blueprint $table) {
            $table->integer('edit_count')->default(0);
            $table->string('uid')->nullable();
            $table->unsignedBigInteger('transaction_status_id')->nullable();
            $table->foreign('transaction_status_id')
                ->on('transaction_statuses')
                ->references('id')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });
        Schema::table('transaction_statuses', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_list_id')->nullable();
            $table->foreign('transaction_list_id')
                ->on('transaction_lists')
                ->references('id')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'edit_count',
            ]);
        });
        Schema::table('transaction_lists', function (Blueprint $table) {
            $table->dropConstrainedForeignId('transaction_status_id');
            $table->dropColumn([
                'edit_count',
                'uid',

            ]);
        });
        Schema::table('transaction_statuses', function (Blueprint $table) {
            $table->dropConstrainedForeignId('transaction_list_id');

        });
    }
};
