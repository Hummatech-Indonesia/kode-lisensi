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
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('first_offer', 50);
            $table->string('first_title', 50);
            $table->string('first_description', 50);
            $table->text('first_product_url');
            $table->text('first_image');
            $table->string('second_offer', 50);
            $table->string('second_title', 50);
            $table->string('second_description', 50);
            $table->text('second_product_url');
            $table->text('second_image');
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
        Schema::dropIfExists('banners');
    }
};
