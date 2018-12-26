<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Archive extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->datetime('creation_date');
            $table->string('size');
            $table->string('dimension');
            $table->string('url');
            $table->string('title');
            $table->string('legend');
            $table->string('alternative_text');
            $table->string('description');
            $table->integer('id_user');
            $table->integer('active');
            $table->timestamps();
        });
    }
    
        // $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('archives');
    }
}
