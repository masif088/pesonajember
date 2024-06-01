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
        Schema::create('transaction_status_attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_status_id');
            $table->string('key');
            $table->text('value');
            $table->string('type');
            $table->timestamps();

            $table->foreign('transaction_status_id')
                ->references('id')
                ->on('transaction_statuses')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_detail_attachments');
    }
};
