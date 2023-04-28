<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('invoice_id', 50);
            $table->foreignUuid('user_id')->constrained();
            $table->integer('fee_amount')->nullable();
            $table->integer('amount');
            $table->text('invoice_url')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->integer('paid_amount')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('payment_channel')->nullable();
            $table->string('payment_method')->nullable();
            $table->enum('license_status', ['PENDING', 'PROCESSED', 'COMPLETED', 'CANCELED'])->default('PENDING');
            $table->enum('invoice_status', ['PAID', 'PENDING', 'SETTLED', 'EXPIRED', 'FAILED'])->default('PENDING');
            $table->foreignUuid('license_id')->nullable()->constrained();
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
};
