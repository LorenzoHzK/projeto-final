<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discount', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->date('startDate');
            $table->date('endDate');
            $table->decimal('discount', 10,2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        //
    }
};
