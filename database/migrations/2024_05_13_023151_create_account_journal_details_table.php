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
        Schema::create('account_journal_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_journal_id');
            $table->unsignedBigInteger('account_name_id');
            $table->decimal('debit',16,2);
            $table->decimal('credit',16,2);
            $table->text('note');
            $table->timestamps();
            $table->foreign('account_journal_id')
                ->references('id')
                ->on('account_journals')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('account_name_id')
                ->references('id')
                ->on('account_names')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_journal_details');
    }
};
