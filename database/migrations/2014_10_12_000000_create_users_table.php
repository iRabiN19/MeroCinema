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
        Schema::create('user', function (Blueprint $table) {
            $table->increments('u_id');
            $table->string('u_Fname', 30);
            $table->string('u_Mname', 30);
            $table->string('u_Lname', 30);
            $table->string('u_email', 40);
            $table->string('u_password', 30);
            $table->date('date_of_birth');
            $table->string('u_phoneNo', 15);
            $table->string('u_username', 30)->unique();
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
