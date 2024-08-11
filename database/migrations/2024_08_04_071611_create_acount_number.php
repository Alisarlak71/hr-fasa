<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('acount_number', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unique();
            $table->string('h_sheba')->unique();
            $table->string('h_hesab')->unique();
            $table->string('h_cart')->unique();
            $table->string('b_sheba')->unique();
            $table->string('b_hesab')->unique();
            $table->string('b_cart')->unique();
            $table->tinyInteger('edit',1)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acount_number');
    }
};
