<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('users', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('email')->unique();
    //         $table->string('password');
    //         $table->string('full_name');
    //         $table->string('phone');
    //         $table->index('cart_item_id');
    //         $table->index('favorites_id');
    //         $table->rememberToken();
    //         $table->timestamps();
    //     });
    // }
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('full_name')->nullable();
            $table->string('phone')->unique();
            $table->rememberToken();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};