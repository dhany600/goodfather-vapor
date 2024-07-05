<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('custom_id'); // This is your custom identifier
            $table->foreignId('user_id')->constrained('users'); // Employee id
            $table->foreignId('customer_id')->constrained('customers'); // Customer id
            $table->string('status_transaksi')->default('Success'); // Set the default value to 1
            $table->bigInteger('total_transaction')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
