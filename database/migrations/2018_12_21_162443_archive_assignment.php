<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArchiveAssignment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('archives_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_post')->unsigned()->nullable();
            $table->integer('id_page')->unsigned()->nullable();
            $table->integer('id_archive')->unsigned();
            $table->integer('active');
            $table->timestamps();

             $table->foreign('id_post')->references('id')->on('posts')->onDelete('cascade');
             $table->foreign('id_page')->references('id')->on('pages')->onDelete('cascade');
             $table->foreign('id_archive')->references('id')->on('archives')->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archives_assignments');
    }
}
