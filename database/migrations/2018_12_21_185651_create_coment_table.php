<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coment');
            $table->integer('id_answer_to')->nullable();
            $table->integer('id_post')->unsigned();
            $table->integer('status_coment');
            $table->datetime('publication_date');
            $table->integer('id_user')->unsigned();
            $table->integer('active');
            $table->timestamps();

            $table->foreign('id_post')->references('id')->on('posts')->onDelete('cascade');
         $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

     

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coments');
    }
}
