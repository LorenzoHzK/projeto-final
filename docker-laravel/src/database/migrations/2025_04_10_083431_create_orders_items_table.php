<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->UnsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->UnsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('product');

            $table->integer('quantity');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
