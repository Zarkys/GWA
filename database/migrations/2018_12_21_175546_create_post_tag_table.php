<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_post')->unsigned();
            $table->integer('id_tag')->unsigned();
            $table->integer('active');
            $table->timestamps();

           // $table->foreign('id_post')->references('id')->on('posts')->onDelete('cascade');
           // $table->foreign('id_tag')->references('id')->on('tags')->onDelete('cascade');
        });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_tags');
    }
}
