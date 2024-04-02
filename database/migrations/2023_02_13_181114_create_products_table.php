<?php

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
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->enum('status', ['stocking', 'preorder']);
            $table->enum('type', ['serial', 'credential', 'description']);
            $table->string('name');
            $table->text('photo')->nullable();
            $table->integer('buy_price');
            $table->integer('sell_price');
            $table->integer('discount')->default(0);
            $table->integer('reseller_discount')->default(0);
            $table->text('description');
            $table->string('short_description', 150)->nullable();
            $table->text('features')->nullable();
            $table->text('installation');
            $table->text('attachment_file')->nullable();
            $table->text('slug');
            $table->boolean('product_recommendation')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
