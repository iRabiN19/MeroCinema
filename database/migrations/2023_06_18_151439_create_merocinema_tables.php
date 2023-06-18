<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Schema::create('user', function (Blueprint $table) {
        //     $table->increments('u_id');
        //     $table->string('u_Fname', 30);
        //     $table->string('u_Mname', 30);
        //     $table->string('u_Lname', 30);
        //     $table->string('u_email', 40);
        //     $table->string('u_password', 30);
        //     $table->date('date_of_birth');
        //     $table->string('u_phoneNo', 15);
        //     $table->string('u_username', 30)->unique();
        // });

        Schema::create('director', function (Blueprint $table) {
            $table->increments('d_id');
            $table->string('d_Fname', 30);
            $table->string('d_Mname', 30);
            $table->string('d_Lname', 30);
        });

        Schema::create('producer', function (Blueprint $table) {
            $table->increments('p_id');
            $table->string('p_Fname', 30);
            $table->string('p_Mname', 30);
            $table->string('p_Lname', 30);
        });

        Schema::create('admin', function (Blueprint $table) {
            $table->increments('a_id');
            $table->string('a_Name', 30);
            $table->string('a_password', 30);
        });

        Schema::create('genre', function (Blueprint $table) {
            $table->increments('g_id');
            $table->string('g_Name', 30);
        });

        Schema::create('languagespoken', function (Blueprint $table) {
            $table->increments('l_id');
            $table->string('language', 30);
        });

        Schema::create('actor', function (Blueprint $table) {
            $table->increments('act_id');
            $table->string('act_Fname', 30);
            $table->string('act_Mname', 30);
            $table->string('act_Lname', 30);
            $table->integer('act_age');
        });

        Schema::create('movie', function (Blueprint $table) {
            $table->increments('m_id');
            $table->string('m_title', 50);
            $table->date('m_releaseDate');
            $table->string('m_duration', 30);
            $table->unsignedInteger('d_id');
            $table->unsignedInteger('a_id');
            $table->foreign('d_id')->references('d_id')->on('director');
            $table->foreign('a_id')->references('a_id')->on('admin');
        });

        Schema::create('movie_genre', function (Blueprint $table) {
            $table->increments('gm_id');
            $table->unsignedInteger('m_id');
            $table->unsignedInteger('g_id');
            $table->foreign('m_id')->references('m_id')->on('movie');
            $table->foreign('g_id')->references('g_id')->on('genre');
        });

        Schema::create('movie_language', function (Blueprint $table) {
            $table->increments('ml_id');
            $table->unsignedInteger('m_id');
            $table->unsignedInteger('l_id');
            $table->foreign('m_id')->references('m_id')->on('movie');
            $table->foreign('l_id')->references('l_id')->on('languagespoken');
        });

        Schema::create('movie_actor', function (Blueprint $table) {
            $table->increments('am_id');
            $table->unsignedInteger('m_id');
            $table->unsignedInteger('act_id');
            $table->foreign('m_id')->references('m_id')->on('movie');
            $table->foreign('act_id')->references('act_id')->on('actor');
        });

        Schema::create('movie_producer', function (Blueprint $table) {
            $table->increments('pm_id');
            $table->unsignedInteger('m_id');
            $table->unsignedInteger('p_id');
            $table->foreign('m_id')->references('m_id')->on('movie');
            $table->foreign('p_id')->references('p_id')->on('producer');
        });

        Schema::create('review', function (Blueprint $table) {
            $table->increments('r_id');
            $table->integer('r_rating');
            $table->unsignedInteger('m_id');
            $table->unsignedInteger('u_id');
            $table->timestamp('r_time')->nullable();
            $table->foreign('m_id')->references('m_id')->on('movie');
            $table->foreign('u_id')->references('u_id')->on('user');
        });
    }

    public function down()
    {
        Schema::dropIfExists('review');
        Schema::dropIfExists('movie_producer');
        Schema::dropIfExists('movie_actor');
        Schema::dropIfExists('movie_language');
        Schema::dropIfExists('movie_genre');
        Schema::dropIfExists('movie');
        Schema::dropIfExists('actor');
        Schema::dropIfExists('languagespoken');
        Schema::dropIfExists('genre');
        Schema::dropIfExists('admin');
        Schema::dropIfExists('producer');
        Schema::dropIfExists('director');
        // Schema::dropIfExists('user');
    }
};
