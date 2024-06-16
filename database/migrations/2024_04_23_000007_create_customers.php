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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('uid');
            $table->string('hash_id');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('village')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('npwp')->nullable();
            $table->date('register')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->restrictOnDelete()
                ->restrictOnUpdate();

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
        Schema::dropIfExists('customers');
    }
};
