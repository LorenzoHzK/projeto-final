<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('address_id');
            $table->foreign('address_id')->references('id')->on('address')->onDelete('cascade');

            $table->datetime('orderDate');
            $table->foreign('cupon_id')->references('id')->on('cupons')->nullable()->onDelete('cascade');
            $table->string('status')->enum('Pending', 'Processing', 'Shipped', 'Completed', 'Canceled');
            $table->decimal(totalAmount, 10,2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        //
    }
};
