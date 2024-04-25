<?php

use App\Enums\BalanceUsedEnum;
use App\Enums\UsedForEnum;
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
        Schema::create('expenditures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('used_for', [UsedForEnum::BUYPRODUK->value, UsedForEnum::OTHERS->value, UsedForEnum::PAYRESELLER->value]);
            $table->enum('balance_used', [BalanceUsedEnum::TRIPAY->value, BalanceUsedEnum::REKENING->value]);
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenditures');
    }
};
