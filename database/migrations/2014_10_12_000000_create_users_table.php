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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('email')->unique();
            $table->string('user_name')->unique();
            $table->string('bio', 100)->nullable();
            $table->string('location')->nullable();          
            $table->string('name')->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('profile_pic')->default('default.jpg');
            $table->date('register_date')->default(date('Y-m-d'));
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
