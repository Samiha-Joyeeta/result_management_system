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
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('registration_number', 20)->unique();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('phone_number', 15)->unique();
            $table->enum('user_type', ['1', '2', '3']); //1=Admin, 2=Instructor, 3=Student
            $table->enum('status', ['0', '1']); //0=Inactive, 1=Active
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
        Schema::dropIfExists('users');
    }
};
