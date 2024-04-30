<?php

use App\Enums\StatusRefundEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('transaction_id')->constrained();
            $table->enum('status', [StatusRefundEnum::ACCEPTED->value, StatusRefundEnum::REJECT->value, StatusRefundEnum::PENDING->value]);
            $table->string('description');
            $table->string('proof');
            $table->string('bank');
            $table->string('rekening_number');
            $table->string('rejected')->nullable();
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
        Schema::dropIfExists('refunds');
    }
};
