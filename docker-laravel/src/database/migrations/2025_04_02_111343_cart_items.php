<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->integer('id');

            $table->UnsignedInteger('cart_id')->unique();
            $table->foreign('cart_id')->references('id')->on('carts');

            $table->UnsignedInteger('product_id')->unique();
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('quantity');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
